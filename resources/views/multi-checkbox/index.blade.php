@extends('template.app')

@section('content')

    <table>
        <thead>
        <tr>
            <th width="1">
                <input-master-checkbox
                        name="master"
                        :total="3"
                        listen="select-single"
                        fire="select-multiple"
                ></input-master-checkbox>
            </th>
            <th>Table Header</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>
                <input-checkbox
                        name="record-1"
                        id="record-1"
                        fire="select-single"
                        listen="select-multiple"
                        true-value="1"
                ></input-checkbox>
            </td>
            <td>Record 1</td>
        </tr>
        <tr>
            <td>
                <input-checkbox
                        name="record-2"
                        id="record-2"
                        fire="select-single"
                        listen="select-multiple"
                        true-value="2"
                ></input-checkbox>
            </td>
            <td>Record 2</td>
        </tr>
        <tr>
            <td>
                <input-checkbox
                        name="record-3"
                        id="record-3"
                        fire="select-single"
                        listen="select-multiple"
                        true-value="3"
                ></input-checkbox>
            </td>
            <td>Record 3</td>
        </tr>
        </tbody>
    </table>

@endsection
