<?php

namespace App\Controllers;

class Admin extends BaseController
{
	public function index()
	{
		return view('login');
	}
	public function exit()
	{
		return view('logout');
	}
}
