    <form action="../res/scripts/feedback.php?en" method="post" name="mailus" id="mailus" onsubmit="return  checkFeedbackEN();">
		   <div id="feedback">
			 <table width="451" align="center" cellpadding="3" cellspacing="3">
			 <tbody>
               <tr>
                 <td width="112">Your message: </td>
                 <td width="316"><textarea  name="wiadomosc" style="width:100%" rows="10" cols="0" class="input-class" ></textarea></td>
               </tr>
               <tr>
                 <td>Name: </td>
                 <td><input name="imie" type="text" style="width:100%" class="input-class" /></td>
               </tr>
               <tr>
                 <td>E-mail adress :</td>
                 <td><input  name="email" type="text" style="width:100%" class="input-class" /></td>
               </tr>
               <tr>
                 <td>Phone:</td>
                 <td><input name="telefon" type="text" style="width:100%" class="input-class" /></td>
               </tr>
               <tr>
                 <td colspan="2">
				 	<div align="center">
                   		<input type="image" src="../res/pic/send.jpg" name="Submit" value="Submit" />
                 	</div>
				 </td>
               </tr>
			 </tbody>
  			 </table>
		 </div>	 
	</form>	