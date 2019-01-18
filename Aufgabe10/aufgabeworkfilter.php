<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Insert title here</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
</head>
<body onload='createTable(); document.getElementById("filter").focus();'>
<div class="container-fluid">
	<h1>Formular</h1>

	<form class="form-horizontal" role="form">
 		<div class="form-group">
    			<label class="control-label col-sm-2">Filter:</label>
    			<div class="col-sm-10">
        			<input class="form-control" id="filter" type="text" placeholder="Stadt oder Gruendungsjahr" onkeyup="createTable()">
      		</div>
  		</div>
	</form>

	<div id="tabelle" >
	</div>

	<div id="unten">
	</div>
</div>
<script>

function createTable()
{
	var staedte = [
	{ "jahr" : 1237, "stadt" : "Berlin", "link" : "http://de.wikipedia.org/wiki/Berlin", "bild" : "images/berlin.png"},
	{ "jahr" : 1624, "stadt" : "New York", "link" : "http://de.wikipedia.org/wiki/New_York_City", "bild" : "images/newyork.png"},
	{ "jahr" : 1252, "stadt" : "Stockholm", "link" : "http://de.wikipedia.org/wiki/Stockholm", "bild" : "images/stockholm.png"},
	{ "jahr" : 852, "stadt" : "Madrid", "link" : "http://de.wikipedia.org/wiki/Madrid", "bild" : "images/madrid.png"},
	{ "jahr" : 1827, "stadt" : "Bremerhaven", "link" : "http://de.wikipedia.org/wiki/Bremerhaven", "bild" : "images/bremerhaven.png"},
	{ "jahr" : 150, "stadt" : "Bremen", "link" : "http://de.wikipedia.org/wiki/Bremen", "bild" : "images/bremen.png"},
	{ "jahr" : 1202, "stadt" : "Bernau", "link" : "http://de.wikipedia.org/wiki/Bernau_bei_Berlin", "bild" : "images/bernau.png"},
	{ "jahr" : 929, "stadt" : "Brandenburg", "link" : "http://de.wikipedia.org/wiki/Brandenburg_an_der_Havel", "bild" : "images/brandenburg.png"},
	{ "jahr" : 805, "stadt" : "Magdeburg", "link" : "http://de.wikipedia.org/wiki/Magdeburg", "bild" : "images/magdeburg.png"},
	{ "jahr" : 1222, "stadt" : "Marburg", "link" : "http://de.wikipedia.org/wiki/Marburg", "bild" : "images/marburg.png"},
	{ "jahr" : 766, "stadt" : "Mannheim", "link" : "http://de.wikipedia.org/wiki/Mannheim", "bild" : "images/mannheim.png"},
	{ "jahr" : 782, "stadt" : "Mainz", "link" : "http://de.wikipedia.org/wiki/Mainz", "bild" : "images/mainz.png"}
	];

	var input = document.getElementById('filter').value;		// eingegbene Daten (Formular)

	var tabelleDiv = document.getElementById('tabelle');
	tabelleDiv.innerHTML = "";
	var table = document.createElement('TABLE');
	table.setAttribute('class', 'table table-striped');		// Bootstrap
	var thead = document.createElement('THEAD');
	var tr = document.createElement('TR');
	var th = document.createElement('TH');
	var tbody = document.createElement('TBODY');
	var td = document.createElement('TD');

	var _tr = tr.cloneNode(false);							// Variable für Clone von tr
	var _td = td.cloneNode(false);							// Variable für Clone von td

	// ab hier Spaltenüberschriften
	var _th = th.cloneNode(false);
	var _text = document.createTextNode('Nr');
	_th.appendChild(_text);
	tr.appendChild(_th);

	_th = th.cloneNode(false);
	_text = document.createTextNode('Jahr');
	_th.appendChild(_text);
	tr.appendChild(_th);

	_th = th.cloneNode(false);
	_text = document.createTextNode('Stadt');
	_th.appendChild(_text);
	tr.appendChild(_th);

	_th = th.cloneNode(false);
	_text = document.createTextNode('Link');
	_th.appendChild(_text);
	tr.appendChild(_th);

	_th = th.cloneNode(false);
	_text = document.createTextNode('Bild');
	_th.appendChild(_text);
	tr.appendChild(_th);

	thead.appendChild(tr);			// Spaltenueberschriften an thead haengen
	table.appendChild(thead);		// thead an die Tabelle haengen

	// hier muessen jetzt die einzelnen Zeilen in die Tabelle eingelesen werden
	// das JSON-Array muss ausgelesen werden (for(i=0; i<staedte.length; i++))
	// Tipp: zunächst einfach alle anzeigen lassen und erst dann das Filtern einbauen
	// Filtern: die Eingabe mit dem jeweiligen Gründungsjahr bzw. der jeweiligen Stadt
	// vergleichen
	// wenn match, dann entsprechende Zeile einfügen
  for (var i = 0; i < staedte.length; i++) {

    console.log(input.length);

    if(staedte[i].stadt.substring(0,input.length).toLowerCase()==input.toLowerCase() || staedte[i].jahr.toString().substring(0,input.length)==input)
  {


    _tr=tr.cloneNode(false);
    _td=td.cloneNode(false);
    text=document.createTextNode((i+1).toString());
    _td.appendChild(text);
    _tr.appendChild(_td);


    _td=td.cloneNode(false);
    text=document.createTextNode(staedte[i].jahr);
    _td.appendChild(text);
    _tr.appendChild(_td);

    _td=td.cloneNode(false);
    text=document.createTextNode(staedte[i].stadt);
    _td.appendChild(text);
    _tr.appendChild(_td);

    _td=td.cloneNode(false);
    let a=document.createElement("A");
    a.setAttribute("href",staedte[i].link);
    a.setAttribute("class","btn btn-success btn-xs");
    a.setAttribute("target","_blank");
    text=document.createTextNode("Info");
    a.appendChild(text);
    _td.appendChild(a);
    _tr.appendChild(_td);

    _td=td.cloneNode(false);
    let img= document.createElement('IMG');
    img.setAttribute("src",staedte[i].bild);
    img.setAttribute("class","img-thumbnail");
    img.setAttribute("alt",staedte[i].stadt);
    img.style.width="50px";

	img.setAttribute("onclick", "bildEinfuegen(this)");
    _td.appendChild(img);
    _tr.appendChild(_td);

    tbody.appendChild(_tr);
  }

  }

	table.appendChild(tbody);

	tabelleDiv.appendChild(table);
}

// hier noch eine Funktion, die das Bild, auf das geklickt wurde, in
// das Div "unten" clont

function bildEinfuegen(bild)
{
	var bildClone= bild.cloneNode(true);
	document.getElementById("unten").appendChild(bildClone);
}

</script>
</body>
</html>
