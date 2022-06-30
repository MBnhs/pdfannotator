function readingWatcher(){
    
    //Setup the setInterval method to run
    //every second. 1000 milliseconds = 1 second.
    setInterval(function(){
        console.log("Atualizando timestamp end de leitura na base");
         
        return $.ajax({
            type: "POST",
            url: "action.php",
            data: { "action": 'updatereading'}
        }).then(function(data){
            data = JSON.parse(data);

            if(data.status === "success") {
                
                return data;

            } else if (data.status === 'error') {
                    notification.addNotification({
                        message: data.reason,
                        type: "error"
                    });
                    if (data.log){
                        console.error(data.log);
                    }
                    setTimeout(function(){
                    let notificationpanel = document.getElementById("user-notifications");
                    while (notificationpanel.hasChildNodes()) {  
                        notificationpanel.removeChild(notificationpanel.firstChild);
                    } 
                    }, 6000);
            }
            return {'status':'error'};
        });
        

    }, 5000);
}

// readingWatcher();