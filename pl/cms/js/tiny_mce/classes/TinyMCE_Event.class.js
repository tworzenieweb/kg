/**
 * $RCSfile: TinyMCE_Event.class.js,v $
 * $Revision: 1.4 $
 * $Date: 2006/02/12 21:29:57 $
 *
 * @author Moxiecode
 * @copyright Copyright � 2004-2006, Moxiecode Systems AB, All rights reserved.
 */

/* The contents of this file will be wrapped in a class later on */

/**
 * Sets the enabled/disabled state of build in events on the specific node.
 * This function is needed since some events gets executed in WYSIWYG mode.
 *
 * @param {HTMLNode} node HTML node to enable/disable events on.
 * @param {boolean} state true/false state if the events should be disabled or enabled.
 * @private
 */
TinyMCE_Engine.prototype._setEventsEnabled = function(node, state) {
	var events = new Array('onfocus','onblur','onclick','ondblclick',
				'onmousedown','onmouseup','onmouseover','onmousemove',
				'onmouseout','onkeypress','onkeydown','onkeydown','onkeyup');

	var evs = tinyMCE.settings['event_elements'].split(',');
	for (var y=0; y<evs.length; y++){
		var elms = node.getElementsByTagName(evs[y]);
		for (var i=0; i<elms.length; i++) {
			var event = "";

			for (var x=0; x<events.length; x++) {
				if ((event = tinyMCE.getAttrib(elms[i], events[x])) != '') {
					event = tinyMCE.cleanupEventStr("" + event);

					if (!state)
						event = "return true;" + event;
					else
						event = event.replace(/^return true;/gi, '');

					elms[i].removeAttribute(events[x]);
					elms[i].setAttribute(events[x], event);
				}
			}
		}
	}
};

/**
 * Patch function for MSIE specific events, this one simply grabs the window.event object and
 * passes it as a argument to the handleEvent function of the TinyMCE_Engine class.
 *
 * @param {string} editor_id Editor id to patch.
 * @private
 */
TinyMCE_Engine.prototype._eventPatch = function(editor_id) {
	// Remove odd, error
	if (typeof(tinyMCE) == "undefined")
		return true;

	for (var i=0; i<document.frames.length; i++) {
		try {
			if (document.frames[i].event) {
				var event = document.frames[i].event;

				if (!event.target)
					event.target = event.srcElement;

				TinyMCE_Engine.prototype.handleEvent(event);
				return;
			}
		} catch (ex) {
			// Ignore error if iframe is pointing to external URL
		}
	}
};

/**
 * Unload document event handler function. This function will be executed when the
 * page is unloaded, this will automaticly move the current editor contents to the textarea element this enables
 * the editor to restore it's state when the user presses the back button in the browser.
 * This will execute the triggerSave function.
 */
TinyMCE_Engine.prototype.unloadHandler = function() {
	tinyMCE.triggerSave(true, true);
};

/**
 * Adds the handleEvent function to the specified editor instance.
 *
 * @param {string} editor_id Editor control instance to add event handler to.
 */
TinyMCE_Engine.prototype.addEventHandlers = function(editor_id) {
	if (tinyMCE.isMSIE) {
		var doc = document.frames[editor_id].document;

		// Event patch
		tinyMCE.addEvent(doc, "keypress", TinyMCE_Engine.prototype._eventPatch);
		tinyMCE.addEvent(doc, "keyup", TinyMCE_Engine.prototype._eventPatch);
		tinyMCE.addEvent(doc, "keydown", TinyMCE_Engine.prototype._eventPatch);
		tinyMCE.addEvent(doc, "mouseup", TinyMCE_Engine.prototype._eventPatch);
		tinyMCE.addEvent(doc, "click", TinyMCE_Engine.prototype._eventPatch);
	} else {
		var inst = tinyMCE.instances[editor_id];
		var doc = inst.getDoc();

		inst.switchSettings();

		tinyMCE.addEvent(doc, "keypress", tinyMCE.handleEvent);
		tinyMCE.addEvent(doc, "keydown", tinyMCE.handleEvent);
		tinyMCE.addEvent(doc, "keyup", tinyMCE.handleEvent);
		tinyMCE.addEvent(doc, "click", tinyMCE.handleEvent);
		tinyMCE.addEvent(doc, "mouseup", tinyMCE.handleEvent);
		tinyMCE.addEvent(doc, "mousedown", tinyMCE.handleEvent);
		tinyMCE.addEvent(doc, "focus", tinyMCE.handleEvent);
		tinyMCE.addEvent(doc, "blur", tinyMCE.handleEvent);

		eval('try { doc.designMode = "On"; } catch(e) {}');
	}
};

/**
 * Mouse move handler function, this will be executed each time
 * the mouse is moved within a editor instance. This function stores away the current selection in MSIE
 * this will then be used when a undo/redo level is added.
 */
TinyMCE_Engine.prototype.onMouseMove = function() {
	var inst;

	if (!tinyMCE.hasMouseMoved) {
		inst = tinyMCE.selectedInstance;
		inst.undoBookmark = inst.selection.getBookmark();
		tinyMCE.hasMouseMoved = true;
	}

//	tinyMCE.cancelEvent(inst.getWin().event);
//	return false;
};

/**
 * Cancels the specified event, this will disable the event from be passed to other listeners in event chain.
 *
 * @param {DOMEvent} e Event to cancel.
 */
TinyMCE_Engine.prototype.cancelEvent = function(e) {
	if (tinyMCE.isMSIE) {
		e.returnValue = false;
		e.cancelBubble = true;
	} else
		e.preventDefault();
};

/**
 * Adds a event handler function to the specified object.
 *
 * @param {HTMLElement} o Object to add event handler to.
 * @param {string} n Event name to listen to for example "click".
 * @param {function} h Function handler to execute when event occurs.
 */
TinyMCE_Engine.prototype.addEvent = function(o, n, h) {
	if (o.attachEvent)
		o.attachEvent("on" + n, h);
	else
		o.addEventListener(n, h, false);
};

/**
 * Adds accessibility keydown handler to the specified select element.
 *
 * @param {DOMEvent} e Event that gets passed when the element is focused.
 * @param {HTMLElement} s Select element that the keydown handler gets added to.
 * @param {DOMWindow} w DOM window reference to add.
 */
TinyMCE_Engine.prototype.addSelectAccessibility = function(e, s, w) {
	// Add event handlers 
	if (!s._isAccessible) {
		s.onkeydown = tinyMCE.accessibleEventHandler;
		s._isAccessible = true;
		s._win = w;
	}
};

/**
 * Accessibility handler that gets executed when the user hits a key in a select element.
 * This handler trams the enter/return or space key and then executes the onchange event handler.
 *
 * @param {DOMEvent} e DOM event object instance.
 */
TinyMCE_Engine.prototype.accessibleEventHandler = function(e) {
	var win = this._win;
	e = tinyMCE.isMSIE ? win.event : e;
	var elm = tinyMCE.isMSIE ? e.srcElement : e.target;

	// Piggyback onchange
	if (elm.nodeName == "SELECT" && !elm.oldonchange) {
		elm.oldonchange = elm.onchange;
		elm.onchange = null;
	}

	// Execute onchange and remove piggyback
	if (e.keyCode == 13 || e.keyCode == 32) {
		elm.onchange = elm.oldonchange;
		elm.onchange();
		elm.oldonchange = null;
		tinyMCE.cancelEvent(e);
	}
};
