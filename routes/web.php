<?php

use App\Http\Controllers\BotController;
use App\Livewire\AtributeCompoennt;
use App\Livewire\CategoryComponent;
use App\Livewire\CharacteristicsComponent;
use App\Livewire\ElementComponent;
use App\Livewire\ProductComponent;
use Illuminate\Support\Facades\Route;

Route::get('/',CategoryComponent::class);
Route::get('/attributes', AtributeCompoennt::class);
Route::get('/characteristics', CharacteristicsComponent::class)->name('characteristics');
Route::get('/products', ProductComponent::class)->name('products');
Route::get('/elements', ElementComponent::class)->name('elements');




Route::get('/bot',[BotController::class,'index'])->name('bot');
Route::post('/sendMessageToBot',[BotController::class,'sendMessageToBot'])->name('send');