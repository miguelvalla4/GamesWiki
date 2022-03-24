<?php
declare(strict_types=1);

namespace App\Infrastructure\Slim\Action\Systems;
use PDO;

use App\Infrastructure\Slim\Action\Action;
use Psr\Http\Message\ResponseInterface as Response;

class SystemsAction extends Action
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $_ENV['DATABASE_NAME'];
        $_ENV['DATABASE_USER'];
        $_ENV['DATABASE_PASSWORD'];
        $_ENV['DATABASE_HOST'];
        $_ENV['DATABASE_PORT'];
        
        //Variable que guarda el id del sistema
        $id_sys = $this->request->getAttribute('id');

        $date=date('d-m-Y');
        //Variable que guarda la fecha de referencia para tag VINTAGE
        $vintage=strtotime('-20 year', strtotime($date));
        $vintage=date('Y-m-d',$vintage);
  
        //Variable que guarda la fecha de referencia para tag OLDIE
        $oldie=strtotime('-30 year', strtotime($date));
        $oldie=date('Y-m-d',$oldie);
        
        //Variables necesarias para la paginacion
        $page = isset($_GET['page']) ? $_GET['page']:1;
        $limite =  3;
        $ini = ($page>1) ? (($limite*$page)-$limite):0 ;

        //Consultas
        $sql="SELECT * FROM games WHERE company_id = $id_sys LIMIT :limite OFFSET :ini";
        $sql2 = "SELECT id FROM companies WHERE companies.location  LIKE '%, Japón'";

        
        //Consultas.exe
        try{
            
            $pdo = new PDO('mysql:host=db;dbname=good_old_videogames;charset=utf8mb4',$_ENV['DATABASE_USER'], $_ENV['DATABASE_PASSWORD']);
            $pdo2 = new PDO('mysql:host=db;dbname=good_old_videogames;charset=utf8mb4',$_ENV['DATABASE_USER'], $_ENV['DATABASE_PASSWORD']);

            $stmt = $pdo->prepare($sql);
            $nipon = $pdo2->prepare($sql2);

            $stmt->bindValue(':limite', $limite, \PDO::PARAM_INT);
            $stmt->bindValue(':ini', $ini, \PDO::PARAM_INT);

            $stmt->execute();
            $nipon->execute();
            $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
            $nipon=$nipon->fetchAll(PDO::FETCH_ASSOC);
            $cntReg=$pdo->query("SELECT FOUND_ROWS() as TOTAL");
            $cntReg=$cntReg->fetch()['TOTAL'];

            $nPags=ceil($cntReg/$limite);
            
        }catch(PDOException $e){
            die('Error.');
        }

        //Tag
        foreach($result as $key => $value){
            foreach ($nipon as $i => $valor){
                if($nipon[$i]['id']==$result[$key]['company_id']){
                    $result[$key]['tag'][]="Nipón";
                }
            }
        
            if ((($result[$key]['type']=="Lucha")||($result[$key]['type']=="Beat 'em up"))   ){

                $result[$key]['tag'][]="Machacabotones";
            }
            if($result[$key]['released_on']<=$oldie  ){

                $result[$key]['tag'][]="Oldie but Goldie";

            }elseif($result[$key]['released_on']>$oldie){

                $result[$key]['tag'][]="Vintage";
            }


        }
       
       //return   
        if($page>$nPags){
            return $this->respondWithData([
                'message'=>'No me quedan mas datos que mostrarte :\'(',
                'FILE'=>__FILE__
            ]);
        }{
        return $this->respondWithData([
            'message'=>$result,
            'FILE'=>__FILE__
       
        ]);
        }
    }
  
}
