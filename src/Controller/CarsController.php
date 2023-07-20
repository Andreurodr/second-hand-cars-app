<?php

namespace App\Controller;

use App\Entity\Cars;
use App\Form\CarsType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Request;

class CarsController extends AbstractController
{
    #[Route("/cars", name: "listCars")]
    public function readCars(EntityManagerInterface $doctrine)
    {
        $repository = $doctrine->getRepository(Cars::class);

        $cars = $repository->findAll();

        return $this->render("Cars/listCars.html.twig", ["cars"=>$cars]);
    }

    #[Route("/insert/cars", name: "insertCars")]
    public function insertCar(
        EntityManagerInterface $doctrine,
        Request $request
    ){
        $form = $this->createForm(CarsType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $car = $form->getData();
            $carPhoto = $form->get("carPhoto")->getData();
            if($carPhoto){
                $newCarPhoto = uniqid().".".$carPhoto->guessExtension();
                $carPhoto->move($this->getParameter("kernel.project_dir")."/public/images",
                $newCarPhoto
                );
                $car->setPhotography("/images/$newCarPhoto");
            }
            $doctrine->persist($car);
            $doctrine->flush();
            return $this->redirectToRoute('listCars');
        }
        return $this->render("Cars/insertCars.html.twig", ["carsForm" => $form]);

    }

    #[Route("/cars/{id}", name: "getCar")]
    public function getCars(EntityManagerInterface $doctrine, $id)
    {
        $repositroy = $doctrine->getRepository(Cars::class);
        $car = $repositroy->find($id);

        return $this->render("Cars/cars.html.twig", ["car" => $car]);
    }

    #[Route("/", name: "home")]
    public function home()
    {
        return $this->render("Cars/homeCars.html.twig");
    }
}