//get elements
var preObject = document.getElementById('object');

//create reference
var dbRefObject = firebase.database().ref().child('Users');

//Sync object changes
//dbRefObject.on('value', snap => console.log(snap.val()));

//var childData = new Array(20);
//var i = 0;
/*
dbRefObject.once('value', function (snapshot) {
    snapshot.forEach(function (childSnapshot) {
        var childKey = childSnapshot.key;
        var childData = childSnapshot.val();
        //i++;

        console.log(childKey + " " + childData['first'] + " " + childData['last']); // ...

    });
});
*/

//console.log(user_name + " " + pwd);

function login() {
    var user_name = document.getElementById('username').value;
    var pwd = document.getElementById('password').value;
    var isValid = false;

    // console.log(user_name + " " + pwd);


    dbRefObject.once('value', function (snapshot) {
        snapshot.forEach(function (childSnapshot) {
            var childKey = childSnapshot.key;
            var childData = childSnapshot.val();
            //console.log(childKey + " " + childData); // ...

            if (user_name == childData['name'] &&
                pwd == childData['password']) {
                isValid = true;
            }
        });

        if (isValid == true) {
            document.getElementById('resultDisp').innerHTML = "Forget Password  (Valid User)";
            console.log("Valid user");
        } else {
            /*
            dbRefObject.push().set({
                name: user_name,
                password: pwd
            });
*/
        }
    });

}
