
window.onload = function(){
    var username = decodeURI(location.search.split("=")[1]);
    console.log(username) 
    var Words = document.getElementById("words");
    var TalkWords = document.getElementById("talkwords");
    var TalkSub = document.getElementById("talksub");
 
 
    var title=document.getElementById("title")
    title.innerHTML=username+'Chatroom'
 
    var talk1=document.getElementById("talk1")
    var talk2=document.getElementById("talk2")
    var talk3=document.getElementById("talk3")
    talk1.innerHTML=username+'Hello, everyone!'
    talk2.innerHTML=username+'Hi'
    talk3.innerHTML=username+'Welcome'+username+'Chatroom'
 
    var user=document.getElementById("user")
    user.innerHTML=username
 
 
    
    var back=document.getElementById("back")
    back.onclick=function(){
        window.location.href = ' ./login.html'
    }
    
 
 
    TalkSub.onclick = function(){
        
        var str = "";
        if(TalkWords.value == ""){

            alert("nothing");
            return;
        }
        

            str = '<div class="atalk"><span class="asay">'+username+'Say :' + TalkWords.value +'</span></div>';
    
        Words.innerHTML = Words.innerHTML + str;
        TalkWords.value=""
    }
}