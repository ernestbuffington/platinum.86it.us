<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<!-- DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd" -->
<html dir="{S_CONTENT_DIRECTION}">
<head>
<meta http-equiv="Content-Type" content="text/html; charset={S_CONTENT_ENCODING}">
<meta http-equiv="Content-Style-Type" content="text/css">
<title>{SITENAME} :: {PAGE_TITLE}</title>
<style type="text/css">
<!--
body {
    font-family: {T_FONTFACE1};
    font-size: 12px ;
    letter-spacing: 1px;
}
/* Quote & Code blocks */
.code, .quote, .php {
    font-size: 11px;
	border: black; border-style: solid;
	border-left-width: 1px; border-top-width: 1px; border-right-width: 1px; border-bottom-width: 1px
}
.Forum {
    font-weight : bold;
    font-size: 18px;
}
.Topic {
    font-weight : bold;
    font-size: 14px;
}
.genmed {
    font-size: 12px;
}
hr.sep	{ height: 0px; border: solid #D1D7DC 0px; border-top-width: 1px;}



-->
</style>
</head>
<body>
<span class="Forum"><div align="center">{SITENAME}</div></span><br />
<span class="Topic">{FORUM_NAME} - {TOPIC_TITLE}</span><br />

  <!-- BEGIN postrow -->
   <hr />
  <strong>{postrow.POSTER_NAME}</strong> - {postrow.POST_DATE}<br />
  <strong>{L_POST_SUBJECT}: </strong>{postrow.POST_SUBJECT}<hr width=95% class="sep"/>
  {postrow.MESSAGE}
  <!-- END postrow -->
  <hr />
<div align="center"><br />

  Powered by Platinum &copy; 2007 <a href="http://www.platinumnukepro.com/" target="_blank" class="copyright">PlatinumNuke</a></div>
</body>
</html>
