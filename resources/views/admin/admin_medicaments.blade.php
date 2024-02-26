@extends('layouts.site_admin')

@section('title')
    Admin medicaments
@endsection

@section('content')
    <main>
        <div class="m-6 mb-12 rounded-xl p-6 shadow-xl sm:p-10">
            <h1 class="text-3xl font-semibold">Admin</h1>
            <div class="text">
                <svg class="mx-auto h-12 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                     viewBox="0 0 24 24"
                     stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                <p>
                <h1 class="text-3xl font-semibold">{{auth()->user()->name}}</h1> </p>
            </div>
        </div>
        <div class="text">
                <table id="table">
                    <thead>
                    <tr>
                        <th>id</th>
                        <th>код партии</th>
                        <th>код товара</th>
                        <th>название товара</th>
                        <th>срок годности</th>
                        <th>количество</th>
                        <th>статус</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($medicaments as $medicament)
                    <tr>
                        <td id="id">{{$medicament->id}}</td>
                        <td id="supply" class="">{{$medicament->supply}}</td>
                        <td id="product" class="">{{$medicament->product}}</td>
                        <td id="name" class="">{{$medicament->name}}</td>
                        <td id="date" class="">{{$medicament->date}}</td>
                        <td id="quantity" class="">{{$medicament->quantity}}</td>
                        <td id="status" class="">{{$medicament->status->name}}</td>
                        <th>
                            <form id="">
                                <input type="hidden" name="id" id="id" value="">
                                <button type="submit">Save</button>
                            </form>
                        </th>
                        <th>
                            <form id="delete-">
                                <input type="hidden" name="id" id="id" value="">
                                <button type="submit">Delete</button>
                            </form>
                        </th>
                        <th>
                            <a href="">Date</a>
                        </th>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            <pre>
            <form enctype="multipart/form-data" action="{{route('excel')}}" method="POST">
                @csrf
                <input type="hidden" name="MAX_FILE_SIZE" value="30000"/>
                Загрузить файл: <input name="file" type="file"/><br>
                <input type="submit" value="Отправить файл"/>
            </form>
                </pre>
            <h1>Add new medicament</h1>
            <form id="createForm">
                @csrf
                <p>name</p>
                <input type="text" name="name"><br>
                @error('name')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
                <p>surname</p>
                <input type="text" name="surname"><br>
                @error('surname')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
                <p>experience</p>
                <input type="text" name="experience"> <br>
                @error('experience')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
                <button type="submit">add</button>
            </form>
        </div>
    </main>
@endsection
