<?php

use Illuminate\Database\Seeder;

class TestSeed2 extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Note: seeders deactivate fillable/guards for defect
        \Illuminate\Database\Eloquent\Model::reguard();


        $fill=[
            'nombre' => 'dadasdasad',
            'apellido' => 'sdasdasda',
            'correo' => 'fffffffffff',
            'nacimiento' => '1990-01-01',
            'contrato' => '2000-01-01',
            'sueldo' => 22.22,
            'sexo' => 'M',
            'direccion' => 'sadasdas',
            'telefono' => '3232',
            'DNI' => '97873400',
            'asassds'=>'fdsfdsf',
            'created_at'=>'2001-01-01',

//            'name' => 'dadasdasad',
//            'lastName' => 'sdasdasda',
//            'email' => 'erererewr',
//            'birthDate' => '1990-01-01',
//            'contractDate' => '2000-01-01',
//            'salary' => 22.22,
//            'gender' => 'M',
//            'address' => 'sadasdas',
//            'phone' => '3232',
//            'DNI' => '44455566',
//            'asassds'=>'fdsfdsf',
//            'created_at'=>'2001-01-01',
        ];
        //
        $p = new \App\models\Personal();
//        throw new Exception(json_encode($p->getMaps()));
//        $p->fill([
//            'nombre' => 'dadasdasad',
//            'apellido' => 'sdasdasda',
//            'correo' => 'dasdasd',
//            'nacimiento' => '1990-01-01',
//            'contrato' => '2000-01-01',
//            'sueldo' => 22.22,
//            'sexo' => 'M',
//            'direccion' => 'sadasdas',
//            'telefono' => '3232',
//            'DNI' => '66677789',
//        ]);
//
//        $p->save();
//        $p->create([
//            'nombre' => 'dadasdasad',
//            'apellido' => 'sdasdasda',
//            'correo' => 'fdsfsdfds',
//            'nacimiento' => '1990-01-01',
//            'contrato' => '2000-01-01',
//            'sueldo' => 22.22,
//            'sexo' => 'M',
//            'direccion' => 'sadasdas',
//            'telefono' => '3232',
//            'DNI' => '33344456',
////            'asassds'=>'fdsfdsf',
//            'created_at'=>'2001-01-01',
//        ]);
        $p->create($fill);
//        $p->fill($fill);
//        $p->save();
        throw new \Exception($p->toJson());
    }
}
