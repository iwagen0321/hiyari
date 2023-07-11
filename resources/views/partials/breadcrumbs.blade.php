@unless ($breadcrumbs->isEmpty())

    <ol class="Breadcrumb-ListGroup">
        @foreach ($breadcrumbs as $breadcrumb)

            @if (!is_null($breadcrumb->url) && !$loop->last)
                <li class="Breadcrumb-ListGroup-Item">
                    <a class="Breadcrumb-ListGroup-Item-Link" href="{{ $breadcrumb->url }}">{{ $breadcrumb->title }}</a></li>
            @else
                <li class="Breadcrumb-ListGroup-Item">{{ $breadcrumb->title }}</li>
            @endif

        @endforeach
    </ol>

    <style>
        .Breadcrumb {
            padding: 1em;
        }
        .Breadcrumb-ListGroup {
            display: flex;
        }
        .Breadcrumb-ListGroup-Item-Link[href]:hover {
            opacity: 0.5;
        }
        .Breadcrumb-ListGroup > * + * {
            margin-left: 0.5em;
        }
        .Breadcrumb-ListGroup > * + *::before {
            content: ">";
            margin-left: 0.75em;
            margin-right: 0.75em;
        }
    </style>

@endunless