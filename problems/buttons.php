<head>
<style>

input.button{
cursor:pointer; /*forces the cursor to change to a hand when the button is hovered*/
padding:0.8px 15px; /*add some padding to the inside of the button*/
background:#35b128; /*the colour of the button*/
border:1px solid #33842a; /*required or the default border for the browser will appear*/
/*give the button curved corners, alter the size as required*/
-moz-border-radius: 3.5;
-webkit-border-radius: 3.5px;
border-radius: 3.5px;
/*give the button a drop shadow*/
-webkit-box-shadow: 0 0 4px rgba(0,0,0, .75);
-moz-box-shadow: 0 0 4px rgba(0,0,0, .75);
box-shadow: 0 0 4px rgba(0,0,0, .75);
}
/***NOW STYLE THE BUTTONS HOVER AND FOCUS STATES***/
input.button:hover, input#gobutton:focus{
background-color :#399630; /*make the background a little darker*/
/*reduce the drop shadow size to give a pushed button effect*/
-webkit-box-shadow: 0 0 1px rgba(0,0,0, .75);
-moz-box-shadow: 0 0 1px rgba(0,0,0, .75);
box-shadow: 0 0 1px rgba(0,0,0, .75);
}

textarea {
    background-color:HoneyDew;
    color:black;
    position: right;
    left: 30px;
    right: 30px;
    top: 30px;
    bottom: 30px;
}
</style>
<script language="javascript" type="text/javascript" src="./highlighter/edit_area/edit_area_full.js"></script>
	<script language="Javascript" type="text/javascript">
		// initialisation
		editAreaLoader.init({
			id: "example_1"	// id of the textarea to transform		
			,start_highlight: true	// if start with highlight
			,allow_resize: "both"
			,allow_toggle: true
			,word_wrap: true
			,language: "en"
			,syntax: "php"	
		});
		
		editAreaLoader.init({
			id: "example_2"	// id of the textarea to transform	
			,start_highlight: true
			,allow_toggle: false
			,language: "en"
			,syntax: "html"	
			,toolbar: "search, go_to_line, |, undo, redo, |, select_font, |, syntax_selection, |, change_smooth_selection, highlight, reset_highlight, |, help"
			,syntax_selection_allow: "css,html,js,php,python,vb,xml,c,cpp,sql,basic,pas,brainfuck"
			,is_multi_files: true
			,EA_load_callback: "editAreaLoaded"
			,show_line_colors: true
		});
		
		editAreaLoader.init({
			id: "example_3"	// id of the textarea to transform	
			,start_highlight: true	
			,font_size: "8"
			,font_family: "verdana, monospace"
			,allow_resize: "y"
			,allow_toggle: false
			,language: "fr"
			,syntax: "css"	
			,toolbar: "new_document, save, load, |, charmap, |, search, go_to_line, |, undo, redo, |, select_font, |, change_smooth_selection, highlight, reset_highlight, |, help"
			,load_callback: "my_load"
			,save_callback: "my_save"
			,plugins: "charmap"
			,charmap_default: "arrows"
				
		});
		
		editAreaLoader.init({
			id: "example_4"	// id of the textarea to transform		
			//,start_highlight: true	// if start with highlight
			//,font_size: "10"	
			,allow_resize: "no"
			,allow_toggle: true
			,language: "de"
			,syntax: "python"
			,load_callback: "my_load"
			,save_callback: "my_save"
			,display: "later"
			,replace_tab_by_spaces: 4
			,min_height: 350
		});
		
		// callback functions
		function my_save(id, content){
			alert("Here is the content of the EditArea '"+ id +"' as received by the save callback function:\n"+content);
		}
		
		function my_load(id){
			editAreaLoader.setValue(id, "The content is loaded from the load_callback function into EditArea");
		}
		
		function test_setSelectionRange(id){
			editAreaLoader.setSelectionRange(id, 100, 150);
		}
		
		function test_getSelectionRange(id){
			var sel =editAreaLoader.getSelectionRange(id);
			alert("start: "+sel["start"]+"\nend: "+sel["end"]); 
		}
		
		function test_setSelectedText(id){
			text= "[REPLACED SELECTION]"; 
			editAreaLoader.setSelectedText(id, text);
		}
		
		function test_getSelectedText(id){
			alert(editAreaLoader.getSelectedText(id)); 
		}
		
		function editAreaLoaded(id){
			if(id=="example_2")
			{
				open_file1();
				open_file2();
			}
		}
		
		function open_file1()
		{
			var new_file= {id: "to\\ é # € to", text: "", syntax: 'c', title: 'Code:'};
			editAreaLoader.openFile('example_2', new_file);
		}
		
		function close_file1()
		{
			editAreaLoader.closeFile('example_2', "to\\ é # € to");
		}
		
		function toogle_editable(id)
		{
			editAreaLoader.execCommand(id, 'set_editable', !editAreaLoader.execCommand(id, 'is_editable'));
		}
	
	</script>
</head>

<body>
<?php
session_start();
if(isset($_SESSION['username'])){
	echo '<form method="POST" action="logout.php">
<input class="button" style="margin-left:7cm;background-color:green;font-family:Courier New;color:white;" type=submit name=logoutbutton value="Logout">
</form>';
	$filename=basename($_SERVER['PHP_SELF']);
	$problemcode=str_replace(".php","",$filename);
	echo '<form method="POST" action=".qwertyuiopmnbvcxzasdfghjkl/judge.php">
<b style="margin-left:7cm;">Please insert your source code:<b><br>
&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<textarea id="example_2" placeholder="Write your code here..." rows="20" cols="70" name="code">
</textarea><br>
<b style="margin-left:7cm;">Language:</b><br>
<select style="margin-left:7cm;"name="language">
  <option value="C">C</option>
  <option value="C++">C++</option>
  <option value="Python">Python</option>
  <option value="AWK">AWK</option>
</select><br>
<b style="margin-left:7cm;">Problem code:</b><br>
<input style="margin-left:7cm;" type="text" name="problemcode" value="'.$problemcode.'">
<input class="button" style="background-color:orange;font-family:Courier New;color:white;" name="submit" type="submit" value="Send">
	      </form>';
echo '</p><br><br>';
}
else{
	echo '<p style="margin-left:7cm;font-family:Courier New;color:red;">Please login or register to submit your solutions.<p>';
	echo '<form method="POST" action="../login.php">
		<input class="button" style="margin-left:7cm;background-color:green;font-family:Courier New;color:white;" type=submit name="loginbutton" value="Login">
		</form>';
	echo '<form method="POST" action="../register.php">
		<input class="button" style="margin-left:7cm;background-color:green;font-family:Courier New;color:white;" type=submit name="loginbutton" value="Register">
		</form>';
}
?>
</body>

