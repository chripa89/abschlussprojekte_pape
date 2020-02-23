"use strict";

function kontakt() {
  if(document.kontakt_form.vorname.value == "")
  {
  document.getElementById('n1_name').style.display = 'block';
  window.setTimeout("document.getElementById('n1_name').style.display = 'none'", 3000);
  document.kontakt_form.vorname.focus();
  return false;}
  
  if(document.kontakt_form.nachname.value == "")
  {
  document.getElementById('n2_name').style.display = 'block';
  window.setTimeout("document.getElementById('n2_name').style.display = 'none'", 3000);
  document.kontakt_form.nachname.focus();
  return false;}
  
  

  
  if(document.kontakt_form.email.value == "")
  { 
  document.getElementById('n3_mail').style.display = 'block';
  window.setTimeout("document.getElementById('n3_mail').style.display = 'none'", 3000);
  document.kontakt_form.email.focus();
  return false;}
  
  if(document.kontakt_form.email.value.indexOf('@') == -1)
  {
  
  document.getElementById('n3_mail2').style.display = 'block';
  window.setTimeout("document.getElementById('n3_mail2').style.display = 'none'", 3000); 
  document.kontakt_form.email.focus();
  return false;
  }
  
  if(document.kontakt_form.email.value.indexOf('.') == -1)
  {

  document.getElementById('n3_mail2').style.display = 'block';
  window.setTimeout("document.getElementById('n3_mail2').style.display = 'none'", 3000); 
  document.kontakt_form.email.focus();
  return false;
  }
  if(document.kontakt_form.login.value == "")
  {
  document.getElementById('n1_login').style.display = 'block';
  window.setTimeout("document.getElementById('n1_login').style.display = 'none'", 3000);
  document.kontakt_form.login.focus();
  return false;}

 if(document.kontakt_form.password.value == "")
  { 
  document.getElementById('n1_password').style.display = 'block';
  window.setTimeout("document.getElementById('n1_password').style.display = 'none'", 3000);
  document.kontakt_form.password.focus();
  return false;}

 if(document.kontakt_form.password.value == "")
  { 
  document.getElementById('n1_password').style.display = 'block';
  window.setTimeout("document.getElementById('n1_password').style.display = 'none'", 3000);
  document.kontakt_form.password.focus();
  return false;}

 if(document.kontakt_form.confirm_password.value == "")
  {
  document.getElementById('n3_password').style.display = 'block';
  window.setTimeout("document.getElementById('n3_password').style.display = 'none'", 3000);
  document.kontakt_form.confirm_password.focus();
  return false;}



 if(document.kontakt_form.password.value !== document.kontakt_form.confirm_password.value  )
  { 
  document.getElementById('n2_password').style.display = 'block';
  window.setTimeout("document.getElementById('n2_password').style.display = 'none'", 3000);
  document.kontakt_form.confirm_password.focus();
  return false;}
}