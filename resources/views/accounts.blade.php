@extends('layouts.app')

@push('styles')
    <link href="{{ asset('css/accounts.css') }}" rel="stylesheet">
    <style type="text/css">
        h2{
            font-size: 1.75em;
            display: flex;
            align-items: center;
            text-transform: capitalize;
            border-bottom: 1px solid #4caf50;
            padding-bottom: 20px;
        }

        .radio-buttons{
            display: flex;
            margin: 5px 0 20px 0;
            align-items: center;
        }

        .radio-buttons label:first-child{
            margin-right: 1em;
            color: #f3ad2f;
        }

        .radio-buttons label:not(:first-child){
            margin-right: 1em;
            padding: 0 0.5em 0 0.25em;
        }

        .check-pass{
            position: absolute;
            right: 0;
            background-color: transparent;
            border: none;
            color: #DDD;
            transform: translate(0, 1em) scale(0.8,0.8);
            cursor: pointer;
        }
    </style>
@endpush

@section('content')
<div class="toolbar">
    <div class="searchbar-container">
        <input type="text" id="search-bar" name="keyword" placeholder="Search...">
        <button class="btn-floating light-green" type="submit">
            <i class="material-icons">search</i>
        </button>
    </div>
    <a href="#" class="btn btn-success modal-trigger" id="add-button" data-target="add-modal">
        <i class="material-icons">add</i> Add Account 
    </a>
</div>
<div class="container">
    <div class="row">
        <div class="col s12">
            <h4>Admin</h4>
            <ul class="collection">
                <a href="#" class="collection-item"> Rosiebelt Jun Abisado </a>
            </ul>
            <h4>Staff</h4>
            <ul class="collection">
                <a href="#" class="collection-item"> Clyde Joshua Delgado </a>
            </ul>
        </div>
    </div>
</div>
<div id="add-modal" class="modal">
    <div class="modal-content">
        <h4>Add Account</h4>
        <form method="POST" action="{{ route('register') }}" id="register-form">
            @csrf


            <div class="input-field">
                <input id="username" type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" required>
                <label for="username">Username</label>
                @if ($errors->has('username'))
                    <span class="helper-text error">{{ $errors->first('username') }}</span>
                @endif
            </div>

            <div class="input-field">
                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required>
                <label for="name">Name</label>
                @if ($errors->has('name'))
                    <span class="helper-text error">{{ $errors->first('name') }}</span>
                @endif
            </div>


            <div class="radio-buttons">
                <label>Gender</label>
                <label>
                    <input type="radio" value="female" name="gender" checked>
                    <span>Female</span>
                </label>
                <label>
                    <input type="radio" value="male" name="gender">
                    <span>Male</span>
                </label>
            </div>

            <div class="input-field">
                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
                <label for="email">E-mail Address</label>
                @if ($errors->has('email'))
                    <span class="helper-text error">{{ $errors->first('email') }}</span>
                @endif
            </div>


            <div class="input-field">
                <input id="group" type="text" class="form-control{{ $errors->has('group') ? ' is-invalid' : '' }}" name="group" value="{{ old('group') }}" required>
                <label for="group">Group</label>
            </div>

            <div class="input-field">
                <span class="check-pass" id="show-pass"><i class="material-icons">visibility</i></span>
                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                <label for="password">Password</label>
                @if ($errors->has('password'))
                    <span class="helper-text error">{{ $errors->first('password') }}</span>
                @endif
            </div>


            <div class="input-field">
                <span class="check-pass" id="show-passC"><i class="material-icons">visibility</i></span>
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                <label for="password-confirm">Confirm Password</label>
            </div>

            <button type="submit" id="register" class="btn btn-block amber accent-4 disabled hidden"> Register </button>
        </form>
    </div>
</div>
@endsection

@push('scripts')
    <script type="text/javascript">
        $(".modal").modal()
    </script>
    <script type="text/javascript">

        $("#register-form").change(validateForm)

        function validateForm(){
            if (validUsername() && validName() && validEmail() && validGroup() && validPassword() && validConfirmPass()){
                $("#register").removeClass("disabled")
                $("#register").slideDown()
            } else {
                $("#register").addClass("disabled")
                $("#register").slideUp()
            }
        }  

        function validUsername(){
            let username = $("#username").val()
                        
            if (username) {
                return true
            }
            return false
        }
 


        function validName(){
            let name = $("#name").val()
            
            if (name) {
                return true
            }
            return false
        }
        
        function validEmail(){
            let email = $("#email").val()
            
            if (email) {
                return true
            }
            return false
        }
        
        function validGroup(){
            let group = $("#group").val()
            
            if (group) {
                return true
            }
            return false
        }
        
        function validPassword(){
            let password = $("#password").val()
            
            if (password) {
                return true
            }
            return false
        }
        
        function validConfirmPass(){
            let confirmPass = $("#password-confirm").val()
            
            if (confirmPass) {
                return true
            }
            return false
        }

        $("#show-pass").mousedown(function(){showPassword("#show-pass")}).mouseup(function(){hidePassword("#show-pass")})
        $("#show-passC").mousedown(function(){showPassword("#show-passC")}).mouseup(function(){hidePassword("#show-passC")})

        function showPassword(target){ $(target + " ~ input[type='password']").eq(0).attr("type", "text") }
        function hidePassword(target){ $(target + " ~ input[type='text']").eq(0).attr("type", "password") }
        
    </script>
@endpush
