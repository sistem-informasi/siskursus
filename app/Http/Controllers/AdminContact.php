<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Data\Contact;
use LaraCrud\LaraCrudController;

/**
 * Admin Page for Contact Table
 */
class AdminContact extends Controller
{
    use LaraCrudController;

    protected $model;
    protected $route = '/admin/contact';
    protected $crudName = 'Contact';
    protected $views = 'vendor.laracrud';

    protected $displayable = [
        'name',
        'address',
        'phone',
        'email',
    ];

    /*
    protected $events = [
    	'store' => [
			'class'  => 'App\Events\ExampleEvent',
			'params' => ['result', 'request:password']
    	]
    ];
    */

	public function __construct(Contact $contact)
	{
		$this->model = $contact;
	}


	/**
	 * Method called when post resource has been overwritten
	 * eg: encrypt password before storing
	 *
	 * @param  Illuminate\Http\Request Request $request
	 * @return Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
	 */
	public function modifyRequest(Request $request)
    {
        /*
    	$request->merge([
			'password'        => bcrypt($request->password)
    	]);

        return $this->store($request);
        */
    }
}
