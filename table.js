
var xhr = new XMLHttpRequest();
xhr.open('GET', '//localhost/asroma/data.json', false);
xhr.send();
if (xhr.status == 200) {
    var answers = xhr.responseText;
    var json = JSON.parse(answers);
    var asromaTable = document.getElementById("asromaTable");
    
    var tr = '<tr class="tabl_ch">'+
		    '<td class="team_name"></td>'+
		    '<td>Игр</td><td>Очков</td>';
	    '</tr>';
    json["table"].forEach(function(item, i, arr) {
        tr = tr + '<tr>'+
		    '<td class="team_name">'+item["teamName"]+'</td>'+
			'<td>'+item["played"]+'</td>'+
			'<td>'+item["points"]+'</td>'
		'</tr>';
    });
    
    var divRate = '<div class="rate">'+
	'<div class="ser_name">СЕРИЯ А</div>'+
	'<table class="tabl_ser">'+
	    tr +
	'</table>'+
'</div>';

    asromaTable.innerHTML = divRate;
}



