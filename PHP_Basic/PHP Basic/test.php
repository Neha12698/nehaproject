<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

<div class="progress"> <span class="blue" style="width:0%;"><span>0%</span></span> </div>


<style type="text/css">
	.progress {
height: 20px;
background: #ebebeb;
border-left: 1px solid transparent;
border-right: 1px solid transparent;
border-radius: 10px;
}
.progress > span {
position: relative;
float: left;
margin: 0 -1px;
min-width: 30px;
height: 18px;
line-height: 16px;
text-align: right;
background: #cccccc;
border: 1px solid;
border-color: #bfbfbf #b3b3b3 #9e9e9e;
border-radius: 10px;
background-image: -webkit-linear-gradient(top, #f0f0f0, #dbdbdb 70%, #cccccc);
background-image: -moz-linear-gradient(top, #f0f0f0, #dbdbdb 70%, #cccccc);
background-image: -o-linear-gradient(top, #f0f0f0, #dbdbdb 70%, #cccccc);
background-image: linear-gradient(to bottom, #f0f0f0, #dbdbdb 70%, #cccccc);
-webkit-box-shadow: inset 0 1px rgba(255, 255, 255, 0.3), 0 1px 2px rgba(0, 0, 0, 0.2);
box-shadow: inset 0 1px rgba(255, 255, 255, 0.3), 0 1px 2px rgba(0, 0, 0, 0.2);
}
.progress > span > span {
padding: 0 8px;
font-size: 11px;
font-weight: bold;
color: #404040;
color: rgba(0, 0, 0, 0.7);
text-shadow: 0 1px rgba(255, 255, 255, 0.4);
}
.progress > span:before {
content: '';
position: absolute;
top: 0;
bottom: 0;
left: 0;
right: 0;
z-index: 1;
height: 18px;
background: url("../images/progress.png") 0 0 repeat-x;
border-radius: 10px;
}
.progress .green {
background: #85c440;
border-color: #78b337 #6ba031 #568128;
background-image: -webkit-linear-gradient(top, #b7dc8e, #99ce5f 70%, #85c440);
background-image: -moz-linear-gradient(top, #b7dc8e, #99ce5f 70%, #85c440);
background-image: -o-linear-gradient(top, #b7dc8e, #99ce5f 70%, #85c440);
background-image: linear-gradient(to bottom, #b7dc8e, #99ce5f 70%, #85c440);
}
.progress .red {
background: #db3a27;
border-color: #c73321 #b12d1e #8e2418;
background-image: -webkit-linear-gradient(top, #ea8a7e, #e15a4a 70%, #db3a27);
background-image: -moz-linear-gradient(top, #ea8a7e, #e15a4a 70%, #db3a27);
background-image: -o-linear-gradient(top, #ea8a7e, #e15a4a 70%, #db3a27);
background-image: linear-gradient(to bottom, #ea8a7e, #e15a4a 70%, #db3a27);
}
.progress .orange {
background: #f2b63c;
border-color: #f0ad24 #eba310 #c5880d;
background-image: -webkit-linear-gradient(top, #f8da9c, #f5c462 70%, #f2b63c);
background-image: -moz-linear-gradient(top, #f8da9c, #f5c462 70%, #f2b63c);
background-image: -o-linear-gradient(top, #f8da9c, #f5c462 70%, #f2b63c);
background-image: linear-gradient(to bottom, #f8da9c, #f5c462 70%, #f2b63c);
}
.progress .blue {
background: #5aaadb;
border-color: #459fd6 #3094d2 #277db2;
background-image: -webkit-linear-gradient(top, #aed5ed, #7bbbe2 70%, #5aaadb);
background-image: -moz-linear-gradient(top, #aed5ed, #7bbbe2 70%, #5aaadb);
background-image: -o-linear-gradient(top, #aed5ed, #7bbbe2 70%, #5aaadb);
background-image: linear-gradient(to bottom, #aed5ed, #7bbbe2 70%, #5aaadb);
}
</style>


<script type='text/javascript'>
function loading(percent){
jQuery('.progress span').animate({width:percent},1000,function(){
jQuery(this).children().html(percent);
if(percent=='100%'){
 jQuery(this).children().html('Loading Complete, Redirect to Home Page...&nbsp;&nbsp;&nbsp;&nbsp;');
setTimeout(function(){
jQuery('.container').fadeOut();
location.href="https://www.jqueryscript.net";
},1000);
}
})
}
</script>


<script type="text/javascript">loading('5%');</script> 
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js"></script> 
<script type="text/javascript">loading('20%');</script> 
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/chrome-frame/1.0.2/CFInstall.min.js"></script> 
<script type="text/javascript">loading('40%');</script> 
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/ext-core/3.1.0/ext-core.js"></script> 
<script type="text/javascript">loading('70%');</script> 
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/mootools/1.4.1/mootools-yui-compressed.js"></script> 
<script type="text/javascript">loading('100%');</script> 
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/dojo/1.6.1/dojo/dojo.xd.js"></script>