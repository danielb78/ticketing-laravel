<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Http\Requests\TicketFormRequest;
use App\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class TicketsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tickets = Ticket::all();

        return view('tickets.index')->with('tickets', $tickets);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tickets.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\TicketFormRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(TicketFormRequest $request)
    {
        $slug = uniqid();

        $ticket = new Ticket([
            'title'   => $request->get('title'),
            'content' => $request->get('content'),
            'slug'    => $slug
        ]);

        $ticket->save();

        $this->sendEmail($slug);

        return redirect('/contact')->with('status', 'Your ticket has been created! Its unique id is: ' . $slug);
    }

    /**
     * Display the specified resource.
     *
     * @param  string $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $ticket = Ticket::whereSlug($slug)->first();
        $comments = $ticket->comments()->get();

        return view('tickets.show', compact('ticket', 'comments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string $slug
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $ticket = Ticket::whereSlug($slug)->first();

        return view('tickets.edit')->with('ticket', $ticket);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\TicketFormRequest $request
     * @param  string $slug
     * @return \Illuminate\Http\Response
     */
    public function update(TicketFormRequest $request, $slug)
    {
        $ticket = Ticket::whereSlug($slug)->first();

        $ticket->title = $request->get('title');
        $ticket->content = $request->get('content');

        if ( $request->get('status') != null ) {
            $ticket->status = 0;
        } else {
            $ticket->status = 1;
        }

        $ticket->save();

        return redirect( action( 'TicketsController@edit', ['slug' => $slug]))
            ->with('status', "The ticket {$slug} has updated.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string $slug
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $ticket = Ticket::whereSlug($slug)->firstOrFail();
        $ticket->delete();

        return redirect('/tickets')->with('status', "The ticket {$slug} has been deleted");
    }

    private function sendEmail($slug) {
        $data = [
            'ticket' => $slug
        ];
        Mail::send('email.ticket', $data, function($message) {
            $message->from('no-reply@example.com', 'Daniel Laravel');
            $message->to('boldan.daniel@gmail.com')->subject('There is a new ticket');
        });
    }
}
