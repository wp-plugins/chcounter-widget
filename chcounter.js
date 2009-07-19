function populateHiddenVars() {
   document.getElementById( 'chcounter_widget_available_order' ).value = Sortable.serialize( 'chcounter_available' );
   document.getElementById( 'chcounter_widget_active_order' ).value = Sortable.serialize( 'chcounter_active' );
   return true;
}

function toggleHandle(listID, handleID) {
   var list = document.getElementById(listID);
   var items = list.getElementsByTagName('li');
	
   if ( items.length > 0 ) {
      jQuery('span#'+handleID).fadeOut('fast');//Element.hide(handleID);
   } else {
      jQuery('span#'+handleID).fadeIn('fast');//Element.show(handleID);
   }
	
   return true;
}
