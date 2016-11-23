<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\DBAL\DriverManager;



class DefaultController extends Controller
{
    /**
     * @Route("/{page}", name="homepage" ,defaults={"page"="index"})
     */
    public function indexAction(Request $request,$page="index")
    {


        // replace this example code with whatever you need
        return $this->render('default/'.$page.'.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
        ]);
    }





    /**
     * @Route("/abonado/{page}", name="abonado" ,defaults={"page"="null"})
     */
    public function abonadoAction(Request $request,$page="index")
    {
        if($page == "nuevo"){

            /* Los servicios disponibles */
            $servicios = $this->getServicios();

            /* Las localidades disponibles*/
            $localidades = $this->getLocalidades();

            return $this->render(sprintf('default/%s.html.twig', "abonado_list"),
                            array("servicios"   => $servicios,
                                  "localidades" => $localidades)); 

        }

        if($page == "listado"){
            $abonados = $this->getInstanciaConexion();//$this->getAbonados();

            return $this->render(sprintf('default/%s.html.twig', "abonado_list"),
                            array("debug" => $abonados)); 
        }
        // replace this example code with whatever you need
        return $this->render('default/s'.$page.'.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
        ]);
    }


    /**
     * @Route("/reclamo/{page}", name="reclamo" ,defaults={"page"="null"})
     */
    public function reclamoAction(Request $request,$page="index")
    {
        //Un registro en tabla reclamos con, numero , estado PENDIENTE_REVISIÓN, fecha , la descripción y la vía por donde se relizo. Relaciona Abonado con la conexión.
        if($page = "nuevo") {
            //Parametros del nuevo reclamo
            $idAbonado =    $request->get();
            $idConexion =   $request->get();
            $descripcion =  $request->get();
            $via =          $request->get();
            $fecha =        new \DateTime();
            $estado =       "PENDIENTE_REVISIÓN"; //Hacer una clase abstracta como una enumeración


            $conn = $this->getInstanciaConexion();
            $query = $conn->prepare("
                INSERT INTO 
                Reclamo 
                ('descripcion','estadoReclamo') 
                VALUES (:descrip, :estado)");

            $query->bindParam(':descrip', $descrip);
            $query->bindParam(':estado', $estado);

            $query->execute();
            $idReclamo = $conn->lastInsertId();

            $query = $conn->prepare("
                INSERT INTO 
                RealizaReclamo
                ('idAbonado', 'idReclamo', 'idConexion', 'idVia', 'fechaReclamo')
                VALUES (:abonado,:reclamo, :conexion, :via, :fecha)");

            $query->bindParam(':abonado',  $idAbonado);
            $query->bindParam(':reclamo',  $idReclamo);
            $query->bindParam(':conexion', $idConexion);
            $query->bindParam(':via',      $via);
            $query->bindParam(':fecha',    $fecha);

            $result = false;
            if($query->execute()){
                   $resultado = true;
            }
            return $this->render(sprintf('default/%s.html.twig', "reclamo_resultado"),
                            array("resultado" => $resultado)); 
        }
        if($page = "listado"){

            $reclamos = $this->getReclamos();

        }
        return null;
    }


    // Funciones para obtener todos los registros de las entidades de la base de datos. 


    //SOLO DE PRUEBA: Consutla sobre actores de la DB SAKILA , para probar
    // el mapeo a objeto de una consulta SQL NATIVA
    public function getActor($id = ""){

        //Conexión a la base de datos
        $em = $this->getDoctrine()->getManager();

        //Mappeo de resultados a objetos, necesario para converir una consulta en
        //SQL nativo y traer los datos como objeto. 
        $rsm = new ResultSetMapping();
        $rsm->addEntityResult('AppBundle:Actor', 'a');
        $rsm->addFieldResult('a', 'actor_id', 'actorId');  
        $rsm->addFieldResult('a', 'first_name', 'firstName');
        $rsm->addFieldResult('a', 'last_name', 'lastName');

        // Los abonados 
        $sql_abonado ='SELECT a.actor_id, a.first_name, a.last_name  FROM actor a';

        // Filtro, si existe.
        if($id != ""){

            $sql_abonado.=' WHERE a.actor_id = ?';
            
        }
        //Preparo la sentencia
        $query = $em->createNativeQuery($sql_abonado, $rsm);
        $query->setParameter(1, $id);

        //Ejecuta y obtiene los resultados
        $abonados = $query->getResult();
        return $abonados;
    }



    public function getAbonados($id = ""){

        //Conexión a la base de datos
        $em = $this->getDoctrine()->getManager();

        //Mappeo de resultados a objetos, necesario para converir una consulta en
        //SQL nativo y traer los datos como objeto. 
        $rsm = new ResultSetMapping();
        $rsm->addEntityResult('AppBundle:Abonado', 'a');
        $rsm->addFieldResult('a', 'idAbonado', 'idAbonado');  
        $rsm->addFieldResult('a', 'dni', 'dni');
        $rsm->addFieldResult('a', 'apeNom', 'apeNom');
        $rsm->addFieldResult('a', 'direccion', 'direccion');
        $rsm->addFieldResult('a', 'telefono', 'telefono');
        $rsm->addFieldResult('a', 'telefono', 'telefono');
        $rsm->addFieldResult('a', 'email', 'email');


        // Los abonados 
        $sql_abonado ='SELECT 
                            a.idAbonado, a.dni, a.apeNom,  
                            a.direccion, a.telefono, a.celular, a.email  
                        FROM actor a';

        // Filtro, si existe.
        if($id != ""){

            $sql_abonado.=' WHERE a.idAbonado = ?';
            
        }
        //Preparo la sentencia
        $query = $em->createNativeQuery($sql_abonado, $rsm);
        $query->setParameter(1, $id);

        //Ejecuta y obtiene los resultados
        $abonados = $query->getResult();
        return $abonados;
    }

    public function getServicios($tipo=""){

        /* Servicio STD - Plus - Premium : Una sola tabla*/
         $em = $this->getDoctrine()->getManager();

        $sql_servicios = "
            SELECT 
                s.nomServicio , s.costo,s.cantCanales,
                s.canalesHD,s.canalesPeliculas,s.esPremium, s.esPlus, s.esEstandar 
            FROM Servicio s";

        $rsm = new ResultSetMapping();
        $rsm->addEntityResult('AppBundle:Servicio', 's');
        $rsm->addFieldResult('s', 'idServicio', 'idServicio');
        $rsm->addFieldResult('s', 'nomServicio', 'nomServicio');
        $rsm->addFieldResult('s', 'costo', 'costo');
        $rsm->addFieldResult('s', 'cantCanales', 'cantCanales');
        $rsm->addFieldResult('s', 'cantCanalesHD', 'cantCanalesHD');
        $rsm->addFieldResult('s', 'cantCanalesPeliculas', 'cantCanalesPeliculas');
        $rsm->addFieldResult('s', 'esEstandar', 'esEstandar');
        $rsm->addFieldResult('s', 'esPlus', 'esPlus');
        $rsm->addFieldResult('s', 'esPremium', 'esPremium');

        if($tipo !=""){
            $sql_servicios .= " WHERE ";
            switch ($tipo) {
                case "ESTANDAR":
                    $sql_servicios .= " s.esEstandar = TRUE";
                    break;
                case "PLUS":
                    $sql_servicios .= " s.esPlus = TRUE";
                    break;
                case "PREMIUM":
                    $sql_servicios .= " s.esPremium = TRUE";
                    break;
                default:
                    $sql_servicios .= " s.esEstandar = TRUE";
                    break;
            }
        }
        $query = $em->createNativeQuery($sql_servicios, $rsm);

        //Ejecuta y obtiene los resultados
        $servicios = $query->getResult();
        return $servicios;

    }

    public  function getLocalidades($zona=""){

        $em = $this->getDoctrine()->getManager();
        $rsm = new ResultSetMapping();
        $rsm->addEntityResult('Localidad',  'l');
        $rsm->addFieldResult('l', 'idLocalidad',     'idLocalidad');
        $rsm->addFieldResult('l', 'nombreLocalidad', 'nombreLocalidadme');
        $rsm->addFieldResult('l', 'codigoPostal',    'codigoPostal');
        $rsm->addFieldResult('l', 'nombreZona',      'nombreZona');
        $rsm->addJoinedEntityResult('Zona' , 'z', 'l', 'Localidad');
        $rsm->addFieldResult('z', 'nombreZona', 'nombreZona');

        $sql_localidades = "
                SELECT 
                    l.idLocalidad, l.nombreLocalidad, l.codigoPostal, z.nombreZona 
                FROM Localidad 
                INNER JOIN Zona z  ON l.nombreZona = z.nombreZona";

        if($zona !=""){
            $sql_localidades .= " WHERE l.nombreZona = ?";
        }
        $query = $em->createNativeQuery($sql_localidades, $rsm);

        $query->setParameter(1, $zona);

        //Ejecuta y obtiene los resultados
        $localidades = $query->getResult();


        return $localidades;
    }

    public function getReclamos($estado="",$idAbonado=""){

        $params = array();

        $em = $this->getDoctrine()->getManager();
        $rsm = new ResultSetMapping();
        $rsm->addEntityResult('RealizaReclamo',  'ra');
        $rsm->addFieldResult('ra', 'fechaReclamo', 'fechaReclamo');
        $rsm->addJoinedEntityResult('Reclamo' , 'r', 'ra', 'idReclamo');
        $rsm->addFieldResult('r', 'idReclamo',     'idReclamo');
        $rsm->addFieldResult('r', 'descripcion',   'descripcion');
        $rsm->addFieldResult('r', 'estadoReclamo', 'estadoReclamo');
        $rsm->addJoinedEntityResult('Abonado' , 'a', 'ra', 'idAbonado');
        $rsm->addFieldResult('a', 'idAbonado', 'idAbonado');
        $rsm->addFieldResult('a', 'apeNom', 'apeNom');
        $rsm->addFieldResult('a', 'email', 'email');
        $rsm->addJoinedEntityResult('Localidad' , 'l', 'c', 'idLocalidad');
        $rsm->addFieldResult('l', 'nombreLocalidad', 'nombreLocalidad');

        // Consulta reclamos
        $sql_reclamos= "
                SELECT 
                    r.idReclamo , r.descripcion , r.estadoReclamo
                    ra.idConexion , ra.idVia,
                    a.idAbonado, a.apeNom, a.email,
                    l.nombreLocalidad
                FROM RealizaReclamo ra
                INNER JOIN Reclamo r ON ra.idReclamo = r.idReclamo
                INNER JOIN Abonado a ON ra.idAbonado = a.idAbonado
                INNER JOIN Conexion c ON ra.idConexion = c.idConexion
                INNER JOIN Localidad l ON c.idLocalidad = l.idLocalidad";


        // Filtros
        if($estado !="" || $idAbonado != ""){

            $sql_reclamos .= " WHERE ";

            if($estado !=""){
                $sql_reclamos .= " r.estadoReclamo = :estado";
                array_push($params, array('estado' =>  $estado));
            }
            
            if($idAbonado != ""){
                $sql_reclamos .= ($estado!="")? " AND  " :"";
                $sql_reclamos .= "a.idAbonado = :abonado";
                array_push($params, array('abonado' =>  $idAbonado));
            }
        }

        $query = $em->createNativeQuery($sql_reclamos, $rsm);

        $query->setParameter($params);

        return $query->getResult();
    }


    public function getZona($localidad=""){

        $em = $this->getDoctrine()->getManager();

        //nombreZona
        $sql_zonas = "
            SELECT z.nombreZona
            FROM ZONA ";
        $query = $em->createNativeQuery($sql_reclamos, $rsm);

        return $query->getResult();   
    }

    public function getConexiones($idAbonado , $estado = "", $esMoroso=""){
        //idConexion  direccion   fechaInstalacionReal    coordenadas esMoroso    nombreEstado    idServicio  idLocalidad idAbonado
        $em = $this->getDoctrine()->getManager();

        $params = array("abonado" => $idAbonado);

        $sql_conexiones = "
                SELECT 
                FROM Conexion c
                WHERE c.idAbonado =:abonado";

        if($estado !=""){
            $sql_conexiones .= " AND c.nombreEstado = :estadoConexion ";
            array_push($params, array("estadoConexion" => $estado));
        }
        if($estadoCuenta !=""){
            $sql_conexiones .= " AND c.esMoroso = :esMoroso ";   
            array_push($params, array("esMoroso" => $esMoroso));
        }
        
        $query = $em->createNativeQuery($sql_conexiones, $rsm);

        $query->setParameter($params);

        return $query->getResult();
    }

    public function getEquipoTecnico($zona = ""){
        $em = $this->getDoctrine()->getManager();
        return null;
    }

    public function getHojaDeRuta($fecha=""){

        $em = $this->getDoctrine()->getManager();

        //HojaRuta: idHojaRuta  fechaEmision

        //ConexionEnHojaRuta: idConexion  idHojaRuta

        //Trabajo: idTrabajo   idPrioridad estadoReclamo   idHojaRuta  idTarea

        //Tarea: idTarea    nombreTarea

        $sqlHojaRuta = "
            SELECT 
            h.idHojaRuta , h.fechaEmision,
            ceh.idConexion
            t.idPrioridad , t.estadoReclamo,
            ta.nombreTarea

            FROM HojaRuta h
            INNER JOIN ConexionEnHojaRuta ceh ON h.idHojaRuta = ceh.idHojaRuta 
            INNER JOIN Trabajo t ON h.idHojaRuta = t.idHojaRuta 
            INNER JOIN Tarea ta ON t.idTarea = ta.idTarea";

        if($fecha != ""){
            $sqlHojaRuta .= "";  
        }

        return null;

    }




    // Funciones Ajax para consulta en linea a la base 


    /**
    * Ajax Abonado
    *
    * @Route("/ajaxServicios/abonadoExistente", name="ajax_abonado_existente")
    *
    * @param Request $request
    *
    * @return Response
    */

    public function ajaxAbonadoExistente(Request $request){
        $idAbonado = $request->get("dni_abonado");

        if($this->getAbonados($idAbonado)){
            return new JsonResponse(array('existeAbonado' => "true"));
        }
        return new JsonResponse(array('existeAbonado' => "false"));

    }

    /**
    * Ajax Conexiones de Abonado
    *
    * @Route("/ajaxServicios/abonadoConexiones", name="ajax_abonado_conexiones")
    *
    * @param Request $request
    *
    * @return Response
    */

    public function ajaxAbonadoConexiones(Request $request){

        $idAbonado = $request->get("dni_abonado");

        if($this->getConexiones($idAbonado)){
            $conexiones = $this->getConexiones($idAbonado);
            
            return new JsonResponse(array('existeConexion' => "true"));
        }

        return new JsonResponse(array('existeConexion' => "false"));

    }

    /**
    * Ajax Reclamo
    *
    * @Route("/ajaxServicios/reclamoNuevo", name="ajax_reclamo_nuevo")
    *
    * @param Request $request
    *
    * @return Response
    */

    public function ajaxReclamoNuevo(Request $request){


            //Parametros del nuevo reclamo
            $idAbonado =    $request->get();
            $idConexion =   $request->get();
            $descripcion =  $request->get();
            $via =          $request->get();
            $fecha =        new \DateTime();
            $estado =       "PENDIENTE_REVISIÓN"; //Hacer una clase abstracta como una enumeración


            $conn = $this->getInstanciaConexion();
            $query = $conn->prepare("
                INSERT INTO 
                Reclamo 
                ('descripcion','estadoReclamo') 
                VALUES (:descrip, :estado)");

            $query->bindParam(':descrip', $descrip);
            $query->bindParam(':estado', $estado);

            $query->execute();
            $idReclamo = $conn->lastInsertId();

            $query = $conn->prepare("
                INSERT INTO 
                RealizaReclamo
                ('idAbonado', 'idReclamo', 'idConexion', 'idVia', 'fechaReclamo')
                VALUES (:abonado,:reclamo, :conexion, :via, :fecha)");

            $query->bindParam(':abonado',  $idAbonado);
            $query->bindParam(':reclamo',  $idReclamo);
            $query->bindParam(':conexion', $idConexion);
            $query->bindParam(':via',      $via);
            $query->bindParam(':fecha',    $fecha);

            if($query->execute()){
                return new JsonResponse(array('result' => "true"));
            }
            return new JsonResponse(array('result' => "false"));


            

    }
    /**
    * Ajax Reservas : Valida si un servicio está disponible para esa fecha y horario.
    *
    * @Route("/ajaxServicios/horarioServicio", name="ajax_diponibilidad_servicio")
    *
    * @param Request $request
    *
    * @return Response
    */
    public function ajaxDisponibilidadServicioAction(Request $request){

      $idServicio = $request->get("id_servicio");

      $horarios = $this->getHorariosServicios();

      $encoders = array(new JsonEncoder());
      $normalizers = array(new ObjectNormalizer());

      $serializer = new Serializer($normalizers, $encoders);

      $jsonHorarios = $serializer->serialize($horarios, 'json');

      return new JsonResponse(array('horarios' => $jsonHabitaciones));  
    }








    /*
        Funciones Auxiliares

    */

    public function getInstanciaConexion(){
        return $this->getDoctrine()->getConnection();

    }

}


