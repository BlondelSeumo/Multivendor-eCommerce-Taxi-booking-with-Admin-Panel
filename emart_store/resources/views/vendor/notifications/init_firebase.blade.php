var firebaseConfig = {


apiKey: "<?php echo env('FIREBASE_APIKEY') ?>",
authDomain: "<?php echo env('FIREBASE_AUTH_DOMAIN') ?>",
databaseURL: "<?php echo env('FIREBASE_DATABASE_URL') ?>",
projectId: "<?php echo env('FIREBASE_PROJECT_ID') ?>",
storageBucket: "<?php echo env('FIREBASE_STORAGE_BUCKET') ?>",
messagingSenderId: "<?php echo env('FIREBASE_MESSAAGING_SENDER_ID') ?>",
appId: "<?php echo env('FIREBASE_APP_ID') ?>",
measurementId: "<?php echo env('FIREBASE_MEASUREMENT_ID') ?>",
};

// Initialize Firebase
firebase.initializeApp(firebaseConfig); 
  