//
// function disp( divs ) {
//     var a = [];
//     for ( var i = 0; i < divs.length; i++ ) {
//         a.push( divs[ i ].innerHTML );
//     }
//     $( "span" ).text( a.join( " " ) );
// }
//
// disp( $( "div" ).toArray().reverse() );


$(document).ready(function(){
    console.log("Archivo listo?");

    $("#guardar").on("click", function () {
        console.log("Click de Guardar: ");
    });

});

function getAttributes ( $node ) {
    var attrs = {};

    $.each( $node[0].attributes, function ( index, attribute ) {
        attrs[attribute.name] = attribute.value;
    });

    return attrs;
}