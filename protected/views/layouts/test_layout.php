<html>
<head>
<title>Ajax - Powered / auto-complete plugin for jquery.js</title>

<style type="text/css">

	body {
		font-family: Lucida Grande, Arial, sans-serif;
		font-size: 10px;
		text-align: center;
		margin: 0;
		padding: 0;
		position: relative;
	}
	
	table
	{
		border: 1px;
		background-color: #999;
		font-size: 10px;
	}
	tr
	{
		vertical-align: top;
	}
	th
	{
		text-align: left;
		background-color: #ccc;
	}
	th,
	td
	{
		padding: 2px;
		font-family: Lucida Grande, Arial, sans-serif;
		font-size: 1.2em;
	}
	td
	{
		background-color: #fff;
	}
	
	a {
		font-weight: bold;
		text-decoration: none;
		color: #f30;
	}
	
	a:hover {
		color: #fff;
		background-color: #f30; 
	}
	
	#wrapper {
		width: 600px;
		margin: 10px auto;
		text-align: left;
	}
	
	#content {
		font-size: 1.2em;
		line-height: 1.8em;
	}
	
	#content h1 {
		font-size: 1.6em;
		border-bottom: 1px solid #ccc;
		padding: 5px 0 5px 0;
	}

	#content h2 {
		border-top: 1px solid #ddd;
		padding-top: 5px;
		font-size: 1.2em;
		margin-top: 3em;
	}
	
	#content h3 {
		font-size: 1.1em;
		margin-top: 3em;
	}

	small
	{
		color: #999;
	}

	label
	{
		font-weight: bold;
	}

	
</style>

<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/css/global.css">
<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/css/font-awesome.min.css">
<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/css/plugins.css">
<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/css/restaurant.css">
<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/css/jquery.fancybox.css">
</head>

<body>

<div id="wrapper">
<div id="content">
<h1>Autocomplete Extension for JQuery and Yii</h1>

This example file is taken from the Autcomplete Plugin (www.ramirezcobos.com)
<h2 id="examples">Examples &amp; description</h2>


<h3>Example (JSON)</h3>

<div>
<span class="ac_holder" style="margin-left:100px">
<input style="width: 200px" type="text" id="test_json" value="" />
</span><span id='json_info'></span>
</div>


<h3>Description</h3>

<p>The AutoComplete class adds a pulldown menu of suggested values to a text field. The user can either click directly on a suggestion to enter it into the field, or navigate the list using the up and down arrow keys, selecting a value using the enter key. The values for the suggestion list are to provided as XML, <em>or as JSON</em> (by a PHP, ASP, ASPX script, or similar).</p>

<p>The results of the first request are cached on the client machine and are filtered as the user continues to type, to reduce the number of requests hitting the server.</p>

<p>In the JSON example above a callback function is passed to the AutoComplete instance. It is called when the user selects an entry, and writes the full entry info into an span object.</p>

<h3>Example (XML)</h3>

<div>
  <p><span class="ac_holder" style="margin-left:100px">
    <input style="width: 200px" type="text" id="test_xml" />
    </span><span id='xml_info'></span></p>
  <h2 id="releasenotes2">Usage (this is for the Autocomplete Javascript Plugin *NOT* for the extension</h2>
  <p>The script requires jquery.1.3.2.js or above and a single javascript file to be included in the HEAD:</p>
  <ul>
    <li><code>autocomplete.js</code></li>
  </ul>
  <p>A normal text field is transformed into an AutoComplete text field dynamically by using the following code</p>
  <pre><code>    var options = {
		script:'test.php?json=true&limit=6&',
		varname:'input',
		json:true,
		shownoresults:true,
		maxresults:16,
		callback: function (obj) { 
			$('json_info').update('you have selected: '+obj.id + ' ' +
			obj.value + ' (' + obj.info + ')'); }
		};
		$.autoComplete('#test_json',options);</code>
  </pre>
  <p>The <code>options</code> object contains the options for the AutoComplete instance. Note that the script variable includes the question mark (<code>?</code>) at the end. This is to allow other variables to be passed to the script via <code>GET</code> (to use POST method, you will need to modify the AJAX (-doAjaxRequest function) request and also the , for example <code>script: "http://www.yourserver.com/backend.php?list=countries&amp;"</code>. The <code>varname</code> option is the name of the variable that should contain the current value of the text field, and is simpy added on to the end of the script variable when the script is called, along with the current value of the text field, giving:</p>
  <p><code>http://www.yourserver.com/backend.php?list=countries&amp;variableName=currentValue</code></p>
  <p>The script variable can also be a function:</p>
  <pre><code>script: function (input) { 
		return "test.php?input="+input+"&amp;testid="+document.getElementById('testid').value;
}</code></pre>
  <p>This allows you to build the script URL dynamically, passing variable data from somewhere else in your document (eg. from another field, as in the example above). If the script returns <code>false</code>, no AJAX request will be made. </p>
  <p>The XML output from the script should have the following structure (you can modify this and its client handle via the setSuggestions function of the AutoComplete object:</p>
  <pre><code>&lt;results&gt;
	&lt;rs id="1" info=""&gt;Foobar&lt;/rs&gt;
	&lt;rs id="2" info=""&gt;Foobarfly&lt;/rs&gt;
	&lt;rs id="3" info=""&gt;Foobarnacle&lt;/rs&gt;
&lt;/results&gt;</code>
  </pre>
  <p>A JSON object should have the following structure:</p>
  <pre><code>{ results: [
	{ id: "1", value: "Foobar", info: "Cheshire" },
	{ id: "2", value: "Foobarfly", info: "Shropshire" },
	{ id: "3", value: "Foobarnacle", info: "Essex" }
] }</code>
  </pre>
  <p>The AutoComplete object creates the following XHTML code, inserting as the last element in the <code>body</code>:</p>
  <pre><code>
&lt;div style=&quot;left: 347px; top: 1024px; width: 400px;&quot; class=&quot;autosuggest&quot; id=&quot;ac_testinput_xml&quot;&gt;
	&lt;div class=&quot;ac_header&quot;&gt;
		&lt;div class=&quot;ac_corner&quot;&gt;&lt;/div&gt;
		&lt;div class=&quot;ac_bar&quot;&gt;&lt;/div&gt;
	&lt;/div&gt;
	&lt;ul id=&quot;ac_ul&quot;&gt;
		&lt;li&gt;
			&lt;a name=&quot;1&quot; href=&quot;#&quot;&gt;
			&lt;span class=&quot;tl&quot;&gt; &lt;/span&gt;
			&lt;span class=&quot;tr&quot;&gt; &lt;/span&gt;
			&lt;span&gt;&lt;em&gt;W&lt;/em&gt;aldron, Ashley&lt;br&gt;&lt;small&gt;Leicestershire&lt;/small&gt;&lt;/span&gt;
			&lt;/a&gt;
		&lt;/li&gt;
		&lt;li&gt;
			&lt;a name=&quot;2&quot; href=&quot;#&quot;&gt;
			&lt;span class=&quot;tl&quot;&gt; &lt;/span&gt;
			&lt;span class=&quot;tr&quot;&gt; &lt;/span&gt;
			&lt;span&gt;&lt;em&gt;W&lt;/em&gt;heeler, Bysshe&lt;br&gt;&lt;small&gt;Lincolnshire&lt;/small&gt;&lt;/span&gt;
			&lt;/a&gt;
		&lt;/li&gt;
	&lt;/ul&gt;
	&lt;div class=&quot;ac_footer&quot;&gt;
		&lt;div class=&quot;ac_corner&quot;&gt;&lt;/div&gt;
		&lt;div class=&quot;ac_bar&quot;&gt;&lt;/div&gt;
	&lt;/div&gt;
&lt;/div&gt;
</code>
  </pre>
  <p>The list can then be styled using normal CSS. Check out the CSS file.</p>
  <h3>Timeouts</h3>
  <p> The default timeout is set at 2500 milliseconds. After two and a half seconds of inactivity the list closes itself. However, this timeout is reset each time the user types another character. Furthermore, if the user moves the mouse pointer over the AutoComplete list, the timeout is cancelled altogether, until the mouse pointer is moved off the list.</p>
  <h3>Options</h3>
  <p>The options object can contain the following properties:</p>
  <p>&nbsp;  </p>
</div>
</div>


<h2 id="releasenotes">&nbsp;</h2>
<table>
	<tr>
		<th>Property</th>
		<th>Type</th>
		<th>Default</th>
		<th>Description</th>
	</tr>
	<tr>
		<td><strong>script</strong></td>
		<td>String / Function</td>
		<td>-</td>
		<td>
			<strong>REQUIRED!</strong>
			<br />Either: A string containing the path to the script that returns the results in XML format. (eg, "myscript.php?")
			<br />Or: A function that accepts on attribute, the autosuggest field input as a string, and returns the path to the result script.		</td>
	</tr>
	<tr>
		<td><strong>varname</strong></td>
		<td>String</td>
		<td>"input"</td>
		<td>Name of variable passed to script holding current input.</td>
	</tr>
	<tr>
		<td><strong>minchars</strong></td>
		<td>Integer</td>
		<td>1</td>
		<td>Length of input required before AutoSuggest is triggered.</td>
	</tr>
	<tr>
		<td><strong>className</strong></td>
		<td>String</td>
		<td>"autocomplete"</td>
		<td>Value of the class name attribute added to the generated <code>ul</code>.</td>
	</tr>
	<tr>
		<td><strong>delay</strong></td>
		<td>Integer</td>
		<td>500</td>
		<td>Number of milliseconds before an AutoSuggest AJAX request is fired.</td>
	</tr>
	<tr>
		<td><strong>timeout</strong></td>
		<td>Integer</td>
		<td>2500</td>
		<td>Number of milliseconds before an AutoSuggest list closes itself.</td>
	</tr>
	<tr>
		<td><strong>cache</strong></td>
		<td>Boolean</td>
		<td>true</td>
		<td>Whether or not a results list should be cached during typing.</td>
	</tr>
	<tr>
		<td><strong>offsety</strong></td>
		<td>Integer</td>
		<td>-5</td>
		<td>Vertical pixel offset from the text field.</td>
	</tr>
	<tr>
		<td><strong>shownoresults</strong></td>
		<td>Boolean</td>
		<td>true</td>
		<td>Whether to display a message when no results are returned.</td>
	</tr>
	<tr>
		<td><strong>noresults</strong></td>
		<td>String</td>
		<td>No results!</td>
		<td>No results message.</td>
	</tr>
	<tr>
		<td><strong>callback</strong></td>
		<td>Function</td>
		<td>&nbsp;</td>
		<td>
			A function taking one argument: an object
			<br />
			<br />
			<pre><code>{id:"1", value:"Foobar", info:"Cheshire"}</code></pre>		</td>
	</tr>
	<tr>
		<td><strong>json</strong></td>
		<td>Boolean</td>
		<td>false</td>
		<td>Whether or not a results are returned in JSON format. If not, script assumes results are in XML.</td>
	</tr>
	<tr>
		<td><strong>maxentries</strong></td>
		<td>Integer</td>
		<td>25</td>
		<td>The maximum number of entries being returned by the script. (Should correspond to the LIMIT clause in the SQL query.)</td>
	</tr>
	<tr>
	  <td><strong>onAjaxError</strong></td>
	  <td>function</td>
	  <td>null</td>
	  <td><p>If an Ajax request fails, this function will be called (if any). NOTE: a parameter (HTTP_STATUS) will be passed to the function, so you can display your own custom error message. </p>
        <p><code>onAjaxRequest:function(status){alert(status);}</code></p></td>
    </tr>
	<tr>
	  <td><strong>setWidth</strong></td>
	  <td>Boolean</td>
	  <td>false</td>
	  <td>If set to true, the dropdown list will be within the boundaries of minWidth and maxWidth options.</td>
    </tr>
	<tr>
	  <td><strong>minWidth</strong></td>
	  <td>Integer</td>
	  <td>100</td>
	  <td>If setWidth is equal to true, then the dropdown list will be a minimum width of whatever this option specifies</td>
    </tr>
	<tr>
	  <td><strong>maxWidth</strong></td>
	  <td>Integer</td>
	  <td>200</td>
	  <td>If setWidth is equal to true, then the dropdown list will be a maximum width of whatever this option specifies</td>
    </tr>
	<tr>
	  <td><strong>useNotifier</strong></td>
	  <td>Boolean</td>
	  <td>true</td>
	  <td>true by default, this option will display icons to notify that is an autocomplete textfield and also a spinner when an AJAX call is being made to the server.</td>
    </tr>
</table>
<?php 
	// dont need to in this scenario but...
	echo $content;
?>
<p>&nbsp;</p>
</div>
</div>



</body>
</html>