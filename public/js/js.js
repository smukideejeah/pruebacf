$(document).ready(function(){
    actualiza();
    return false; 
});
$("#send").click(function(){
    var nombre = $('#nombre').val();
    var apellido = $('#apellido').val();
    $.when(
        $.post("/nombre",{
            nom:nombre,
            ape:apellido
        })    
    ).done(function(e){
        //alert(e);
        $('#nombre').val('');
        $('#apellido').val('');
        actualiza();
    });
});

function actualiza(){
    $.when(
        $.post("/muestra")
    ).done(function(e){
        var res = JSON.parse(e);
        var todo = "";
        res.data.forEach(function(e){
            todo+="<tr id='"+e.id+"' onclick='ver(this)' data-toggle='modal' data-target='#modal'><td>"+e.id+"</td><td>"+e.nombre+"</td></tr>";
        });
        $("#cuerpo").html(todo);
    });
}
var n = 0;
var elem;
function ver(e){
    var id = e.id;
    n = id;
    elem = e;
    $.when(
        $.post('/ver/'+id)
    ).done(function(e){
        var res = JSON.parse(e);
        $('#nombrec').html(res.nom.n);
        var tel = "";
        var dir="";
        res.di.forEach(function(e){
            dir+="<tr><td>"+e.dir+"</td></tr>";
        });
        res.te.forEach(function(e){
            tel+="<tr><td>"+e.num+"</td></tr>";
        });
        $("#cuerpotelefono").html(tel);
        $("#cuerpodirecciones").html(dir);
    });
}

$("#sen").click(function(e){
    var tel = $("#tel").val();
    $.when(
        $.post("/itel",{
            id:n,
            tel:tel
        })
    ).done(function(e){
        ver(elem);
        $("#tel").val('');
    });
    
});
$("#sed").click(function(e){
    var dir = $("#direc").val();
    $.when(
        $.post("/idir",{
            id:n,
            dir:dir
        })
    ).done(function(e){
        ver(elem);
        $("#direc").val('');
    });
});

$("#xml").click(function(e){
     $.when(
        $.post("/crear")
    ).done(function(e){
        window.open('public/file.xml', '_blank');
    });
});