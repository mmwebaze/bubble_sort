
function createTable(arr, colorArr) {
    var html='';
    html +='<table width="100%" class="table table-bordered">';
    for(var i =0; i < arr.length; i++){
        html += '<tr>';
        html +='<td><div style="width:'+arr[i]+'%; border: 1px solid #000000; background-color:'+colorArr[i]+';">'+arr[i]+'</div></td>';
        html +='</tr>';
    }
    html +='</table>';
    return html;
}