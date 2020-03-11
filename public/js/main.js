function changeUserWith(userWith, id) {
    if (myName > userWith) {
        usernames = myName + userWith;
    } else {
        usernames = userWith + myName;
    }
    $("#" + curUserId).removeClass('chat-with-active');
    $("#" + id).addClass('chat-with-active');
    curUserId = id;
    // console.log(usernames);

    firebase.database().ref("messages").orderByChild("usernames").equalTo(usernames).on("value", function(snapshot) {
        // console.log(snapshot.val());
        var html = "";
        snapshot.forEach((child) => {
            if (child.val().sender == myName) {
                html += "<div class='parent'><div class='child-1' id='message-" + child.key + "'>";
                html += child.val().message;
                html += "</div></div>";
            } else {
                html += "<div class='parent'><div class='child-2' id='message-" + child.key + "'>";
                html += child.val().message;
                html += "</div></div>";
            }
        });
        html += "<div class='parent' style='height: 65px;'></div>";
        document.getElementById("chatBox").innerHTML = html;
        var d = $('#chatBox');
        d.scrollTop(d.prop("scrollHeight"));
    });
}

function sendMessage() {
    // get message
    var message = document.getElementById("chat-message").value;

    // save in database
    firebase.database().ref("messages").push().set({
        "usernames": usernames,
        "sender": myName,
        "message": message
    });
    document.getElementById("chat-message").value = "";
    var d = $('#chatBox');
    d.scrollTop(d.prop("scrollHeight"));
    // prevent form from submitting
    return false;
}

firebase.database().ref("messages").once("child_added", function(snapshot) {
    firebase.database().ref("messages").orderByChild("usernames").equalTo(usernames).on("value", function(snapshot) {
        // console.log(snapshot.val());
        var html = "";
        snapshot.forEach((child) => {
            if (child.val().sender == myName) {
                html += "<div class='parent'><div class='child-1' id='message-" + child.key + "'>";
                html += child.val().message;
                html += "</div></div>";
            } else {
                html += "<div class='parent'><div class='child-2' id='message-" + child.key + "'>";
                html += child.val().message;
                html += "</div></div>";
            }
        });
        html += "<div class='parent' style='height: 65px;'></div>";
        document.getElementById("chatBox").innerHTML = html;
        var d = $('#chatBox');
        d.scrollTop(d.prop("scrollHeight"));
    });
});