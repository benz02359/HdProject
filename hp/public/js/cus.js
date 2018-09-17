
function saveonclick(){

}


window.onload=function(){
    var firebaseRef=firebase.database().ref("customer");
    firebaseRef.once('value').then(function(dataSnapshot){
        console.log(dataSnapshot.val());
    });
    var firebaseRef2=firebase.database().ref("users");
    firebaseRef2.once('value').then(function(dataSnapshot){
        console.log(dataSnapshot.val());
    });
}
