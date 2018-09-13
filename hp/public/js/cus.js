/* customer firebase js */
import firebase from 'firebase/app';
import 'firebase/database'; // If using Firebase database
import 'firebase/storage';  // If using Firebase storage

function saveonclick(){

}
window.onload=function(){
    var firebaseRef=firebase.database().ref("customers");
    firebaseRef.once('value').then(function(dataSnapshot){
        console.log(dataSnapshot.val());
    });
}
