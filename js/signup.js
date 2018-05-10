//get elements
//var preObject = document.getElementById('object');

//create reference
var dbRefObject = firebase.database().ref().child('Users');

//Sync object changes
//dbRefObject.on('value', snap => console.log(snap.val()));

function signup() {
    var user_name = document.getElementById('username').value;
    var pwd1 = document.getElementById('password1').value;
    var pwd2 = document.getElementById('password2').value;
    var isPwdNotEqual = false;
    var isUserRepeat = false;

    if (pwd1 != pwd2) {
        isPwdNotEqual = true;
        alert("Password are not equal");

    } else {
        dbRefObject.once('value', function (snapshot) {
            snapshot.forEach(function (childSnapshot) {
                var childKey = childSnapshot.key;
                var childData = childSnapshot.val();
                //console.log(childKey + " " + childData); // ...

                if (user_name == childData['username']) {
                    isUserRepeat = true;
                }
            });

            if (isUserRepeat == true) {
                // document.getElementById('resultDisp').innerHTML = "Forget Password  (User Repeat)";

                console.log("Repeat user");

                alert("Repeat user!")

                /*           dbRefObject.push().set({
                               name: user_name,
                               password: pwd1
                           });*/

            } else {
                dbRefObject.push().set({
                    name: user_name,
                    password: pwd1
                });
            }
        });

        /*     dbRefObject.push().set({
            name: user_name,
            password: pwd2
        });
*/
    }

    /*

        dbRefObject.push().set({
            first: user_name,
            last: pwd1
        });*/
}
