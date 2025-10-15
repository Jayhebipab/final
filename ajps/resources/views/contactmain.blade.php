<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
<style>
        .professional-bg {
            background-image: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('{{ asset('images/black_and_white_tattoo.jpg') }}');
            background-size: cover;
            background-position: center;
        }
        .professional-form-bg {
            background-color: rgba(10, 10, 10, 0.9);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        .professional-input {
            background-color: rgba(255, 255, 255, 0.05);
            border-bottom: 2px solid rgba(255, 255, 255, 0.2);
            color: white;
            padding: 0.75rem;
            transition: all 0.3s ease;
        }
        .professional-input:focus {
            outline: none;
            border-bottom-color: #66ccff;
        }
        .professional-input::placeholder {
            color: rgba(255, 255, 255, 0.5);
        }
        select.professional-input {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            cursor: pointer;
            color: rgba(255, 255, 255, 0.5); /* Placeholder color */
        }
        select.professional-input option {
            background-color: black;
            color: white;
        }
    </style>
     @vite(['resources/js/app.js', 'resources/css/app.css'])
</head>
