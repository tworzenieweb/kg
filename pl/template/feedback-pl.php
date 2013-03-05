           <form action="../res/scripts/feedback.php" method="post" name="mailus" id="mailus" onsubmit="return  checkFeedbackPL();">
		   <div id="feedback">
			 <table width="451" align="center" cellpadding="3" cellspacing="3">
			 <tbody>
               <tr>
                 <td width="112">Twoja wiadomo¶æ:</td>
                 <td width="316"><textarea  name="wiadomosc" style="width:100%" rows="10" cols="0" class="input-class" ></textarea></td>
               </tr>
               <tr>
                 <td>Imiê i nazwisko </td>
                 <td><input name="imie" type="text" style="width:100%" class="input-class" /></td>
               </tr>
               <tr>
                 <td>Twój adres e-mail:</td>
                 <td><input  name="email" type="text" style="width:100%" class="input-class" /></td>
               </tr>
               <tr>
                 <td>Telefon:</td>
                 <td><input name="telefon" type="text" style="width:100%" class="input-class" /></td>
               </tr>
               <tr>
                 <td colspan="2">
				 	<div align="center">
                   		<input type="image" src="../res/pic/wyslij.jpg" name="Submit" value="Submit" />
                 	</div>
				 </td>
               </tr>
			 </tbody>
  			 </table>
		 </div>	 
		 </form>	