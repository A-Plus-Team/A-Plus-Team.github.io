var config = {
    apiKey: "AIzaSyDRQYn7si6Y_rnXzbpQcaO2cgktr1hbesE",
    authDomain: "waave-a-plus.firebaseapp.com",
    databaseURL: "https://waave-a-plus.firebaseio.com",
    projectId: "waave-a-plus",
    storageBucket: "waave-a-plus.appspot.com",
    messagingSenderId: "286145905753"
};
firebase.initializeApp(config);

var dbRefObject = firebase.database().ref('Users');
var dbRefDummyObject = firebase.database().ref('Users/dummy');

var dataSnapshot;

dbRefObject.on('value', function (snapshot) {
    //alert("I am in the reading function." + userName + ": " + passWord);
    console.log("In once() method.");
    //            console.log(snapshot.val());

    dataSnapshot = snapshot;

});

function saveScore(score) {
    var loginStatus = localStorage.getItem("loginStatus");

    console.log("loginStatus=" + loginStatus);

    var currentUserKey = localStorage.getItem("userKey");
    var currentUser = localStorage.getItem("currentUser");
    var currentPwd = localStorage.getItem("currentPwd");
    console.log(currentUserKey + "--" + currentUser + "--" + currentPwd + "--" + score);

    console.log("Save scores to database.");
    var data = {
        //user_id: uid,
        user_name: currentUser,
        user_pwd: currentPwd,
        user_score: score
    };

    var updates = {};
    updates[currentUserKey] = data;

    dbRefObject.update(updates);

    //    alert("Score is written successfully!");

}

function loadScore() {
    console.log("Load scores from database.");
    console.log(dataSnapshot.val());
    return dataSnapshot;
}
