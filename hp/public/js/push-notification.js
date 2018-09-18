import firebase from 'firebase';
export const initializeFirebase = () => {
  firebase.initializeApp({
    messagingSenderId: "your messagingSenderId"
  });
}

import React from 'react';
import ReactDOM from 'react-dom';
import App from './App';
import { initializeFirebase } from './push-notification';
ReactDOM.render(<App />, document.getElementById('root'));
initializeFirebase();

export const askForPermissioToReceiveNotifications = async () => {
    try {
      const messaging = firebase.messaging();
      await messaging.requestPermission();
      const token = await messaging.getToken();
      console.log('token do usuário:', token);
      
      return token;
    } catch (error) {
      console.error(error);
    }
  }