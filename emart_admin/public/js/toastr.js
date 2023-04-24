/*
Template Name: Monster Admin
Author: Themedesigner
Email: niravjoshi87@gmail.com
File: js
*/
$(function() {
    "use strict";
      $(".tst1").click(function(){
           $.toast({
            heading: 'Welcome to Monster admin',
            text: 'Use the predefined ones, or specify a custom position object.',
            position: 'top-right',
            loaderBg:'#ff6849',
            icon: 'info',
            hideAfter: 3000, 
            stack: 6
          });

     });

      $(".tst2").click(function(){
           $.toast({
            heading: 'Notification',
            text: 'Traitement en cours.',
            position: 'top-right',
            loaderBg:'#ff6849',
            icon: 'warning',
            hideAfter: 3500, 
            stack: 6
          });

     });
      $(".tst3").click(function(){
           $.toast({
            heading: 'Notification',
            text: 'Traitement effectué avec succès.',
            position: 'top-right',
            loaderBg:'#ff6849',
            icon: 'success',
            hideAfter: 3500, 
            stack: 6
          });

     });

     $(".tst4").click(function(){
           $.toast({
            heading: 'Notification',
            text: 'Echec de traitement.',
            position: 'top-right',
            loaderBg:'#ff6849',
            icon: 'error',
            hideAfter: 3500
            
          });
     });
});

function showInfo(){
     $.toast({
      heading: 'Notification',
      text: 'Welcome to the administration.',
      position: 'top-right',
      loaderBg:'#ff6849',
      icon: 'info',
      hideAfter: 3000, 
      stack: 6
    });
  }

function showWarning(){
     $.toast({
      heading: 'Notification',
      text: 'Ongoing treatment.',
      position: 'top-right',
      loaderBg:'#ff6849',
      icon: 'warning',
      hideAfter: 3500, 
      stack: 6
    });
  }

function showWarningIncorrect(){
     $.toast({
      heading: 'Notification',
      text: 'Enter the information correctly.',
      position: 'top-right',
      loaderBg:'#ff6849',
      icon: 'warning',
      hideAfter: 3500, 
      stack: 6
    });
  }
  function showSuccess(){
     $.toast({
      heading: 'Notification',
      text: 'Treatment done successfully.',
      position: 'top-right',
      loaderBg:'#ff6849',
      icon: 'success',
      hideAfter: 3500, 
      stack: 6
    });
  }
  function showFailed(){
      $.toast({
      heading: 'Notification',
      text: 'Failed treatment.',
      position: 'top-right',
      loaderBg:'#ff6849',
      icon: 'error',
      hideAfter: 3500
      });
  }
          
