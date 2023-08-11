<?php namespace App\Exports;
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;


class UsersExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return User::join('roles', 'users.role_id', '=', 'roles.id')->select('users.id','users.name','users.email','users.phone','roles.name as role_name','users.gender','users.status')->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'Email',
            'Phone',
            'Role',
            'Gender',
            'Status',
        
        ];
    }
}
