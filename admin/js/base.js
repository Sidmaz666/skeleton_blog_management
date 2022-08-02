export function prevent_resub(){

if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}

}
