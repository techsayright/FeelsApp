const form = document.querySelector(".typing-area"),
incoming_id = form.querySelector(".incoming_id").value,
inputField = form.querySelector(".input-field"),
sendBtn = form.querySelector("button"),
chatBox = document.querySelector(".chat-box");
var e_value=document.querySelector(".e_value");

var emotion_var = document.querySelector(".emotion");

form.onsubmit = (e)=>{
    e.preventDefault();
}

inputField.focus();

inputField.onkeyup = ()=>{ //btn disable or enable
    if(inputField.value != ""){
        sendBtn.classList.add("active");

        emotion_var.style.display = "flex";
    }else{
        sendBtn.classList.remove("active");

        emotion_var.style.display = "none";
    }
}

// send click
sendBtn.onclick = ()=>{
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "php/insert-chat.php", true);
    xhr.onload = ()=>{
      if(xhr.readyState === XMLHttpRequest.DONE){
          if(xhr.status === 200){
              inputField.value = "";
              e_value.value = "Joy";
              scrollToBottom();
          }
      }
    }

    let formData = new FormData(form);
    xhr.send(formData);

    
}

chatBox.onmouseenter = ()=>{ //for scroll control
    chatBox.classList.add("active");
}

chatBox.onmouseleave = ()=>{
    chatBox.classList.remove("active");
}

setInterval(() =>{
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "php/get-chat.php", true);
    xhr.onload = ()=>{
      if(xhr.readyState === XMLHttpRequest.DONE){
          if(xhr.status === 200){
            let data = xhr.response;
            chatBox.innerHTML = data;

            if(!chatBox.classList.contains("active")){
                scrollToBottom();
              }
          }
      }
    }
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("incoming_id="+incoming_id); //js thi php taraf value moklva
}, 500);

function scrollToBottom(){
    chatBox.scrollTop = chatBox.scrollHeight;
  }

function emotion(v){
    e_value.value = v;
    // alert(e_value.value);
    emotion_var.style.display = "none";
}
  