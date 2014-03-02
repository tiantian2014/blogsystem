// JavaScript Document
function fri_chk(){
	if(confirm("Do you really want to delete!"))
	{
	return true;
	}
	else
	return false;   
	}
	
function fri(){
	alert("You are not author so you can not delete");	
}
	
	function check(){
		if(myform.txt_title.value=="")
		{
			alert("Blog artical title can not be null!");myform.txt_title.focus();return false;
		}
		if(myform.file.value=="")
		{
			alert("Artical content can not be null!");myform.file.focus();return false;
		}
	}
	helpstat = false;
	basic = false;
	function AddText(NewCode) {
	document.all("file").value+=NewCode
}
function showsize(size) {
	if (helpstat) {
		alert("Font size tag\n set font size.\n variable range 1 - 6.\n 1 minimum 6 maximum.\n Usage: <size="+size+">This "+size+" font</size>");
	} else if (basic) {
		AddTxt="<font size="+size+"></font>";
		AddText(AddTxt);
	} else {                       
		txt=prompt("size "+size,"font"); 
		if (txt!=null) {             
			AddTxt="<font size="+size+">"+txt;
			AddText(AddTxt);
			AddTxt="</font>";
			AddText(AddTxt);
		}        
	}
}

function bold() {
	if (helpstat) 
	{
		alert("Bold tag\n set text bold.\n Usage: <b>This is bold text</b>");
	} 
	else if (basic) 
	{
		AddTxt="<b></b>";
		AddText(AddTxt);
	} 
	else 
	{  
		txt=prompt("Text will become thicker, Please enter here you want to make bold");     
		if (txt!=null) 
		{           
			AddTxt="<b>"+txt;
			AddText(AddTxt);
			AddTxt="</b>";
			AddText(AddTxt);
		}       
	}
}

function italicize() {
	if (helpstat) {
		alert("Italic tag\n set text italic fonts\n Usage:. <i> This is italic </ i> ");
	} else if (basic) {
		AddTxt="<i></i>";
		AddText(AddTxt);
	} else {   
		txt=prompt("Text will become italic "," Please enter here the word you want to set itlic");     
		if (txt!=null) {           
			AddTxt="<i>"+txt;
			AddText(AddTxt);
			AddTxt="</i>";
			AddText(AddTxt);
		}	        
	}
}

function showcolor(color) {
	if (helpstat) {
		alert("Color tag\n Set text color, any color name can be used\n Usage:.. <color="+color+"> Color to be changed to "+ color +" text </ color>");
	} else if (basic) {
		AddTxt="<font color="+color+"></font>";
		AddText(AddTxt);
	} else {  
     	txt=prompt("Choosed color is: "+ color," Please enter here to change the color of text!");
		if(txt!=null) {
			AddTxt="<font color="+color+">"+txt;
			AddText(AddTxt);        
			AddTxt="</font>";
			AddText(AddTxt);
		} 
	}
}

function underline() {
  	if (helpstat) {
		alert("Underlined\n to text underlined\n Usage:. <u> To underline text</u>");
	} else if (basic) {
		AddTxt="<u></u>";
		AddText(AddTxt);
	} else {  
		txt=prompt("Underlined text. "," Text ");     
		if (txt!=null) {           
			AddTxt="<u>"+txt;
			AddText(AddTxt);
			AddTxt="</u>";
			AddText(AddTxt);
		}	        
	}
}