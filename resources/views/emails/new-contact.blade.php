<h1>Ciao Admin</h1>
<div>
    Hai ricevuto il nuovo contatto
    <ul>
        <li>
            <strong>Nome:</strong> {{ $lead->name}}
        </li>
        <li>
            <strong>Email:</strong> {{ $lead->email}}
        </li>
    </ul>
    <p>
        Messagio: <br>
        {{ $lead->message}}
    </p>
</div>