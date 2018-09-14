
function saveonclick(){

}


window.onload=function(){
    var firebaseRef=firebase.database().ref("customers");
    firebaseRef.once('value').then(function(dataSnapshot){
        console.log(dataSnapshot.val());
    });
}
