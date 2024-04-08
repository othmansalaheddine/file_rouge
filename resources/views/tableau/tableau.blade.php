@extends(' base')
@section('title', ' Tableau')

@section('content')

    <h1>Tableau list</h1>
    <table class="table">
        <thead>
        <tr>
            <th>#ID</th>
            <th>Name</th>
            <th>Discription</th>
            <th>Quantity</th>
            <th>Image</th>
            <th>Price</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($tableaus as $tableau)
            <tr>
                <th>#ID</th>
                <th>Name</th>
                <th>Discription</th>
                <th>Quantity</th>
                <th>Image</th>
                <th>Price</th>
                <th>Actions</th>
            </tr>
        @endforeach
        </tbody>
    </table>


@endsection

