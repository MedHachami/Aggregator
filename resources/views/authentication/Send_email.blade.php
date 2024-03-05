<style>
    .body{
        width: auto;
        height: auto;
        display: flex;
        justify-content: center;
        justify-items: center;
    }

    .link{
        width: 50px;
        height: 20px;
        background-color: rgb(36, 37, 37);
        border-radius: 4px;
        
    }
    .link:hover{
        background-color: rgb(70, 72, 73);
    }

</style>

<div class="body">
    
    <a class="link" href="{{route('reset', ['email' => $email, 'token' => $token])}}">click here</a>

</div>

