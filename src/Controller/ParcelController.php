<?php

namespace App\Controller;

use App\Entity\Parcel;
use DateTime;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

// Prefix voor alle routes in de controller
/**
 * @Route("/", name="api_")
 */

// Definieert naam van de controller en extend de AbstractController symfony class.
class ParcelController extends AbstractController
{
    // Behandelt de POST voor een pakket.
    // De @Route("/parcels" is de route van deze endpoint en is toegankelijk via de POST request in de front end.
    // ManagerRegistry $doctrine zorgt ervoor dat er toegang is tot de database. Request $request bevat de informatie van de request die de user verstuurd.
    /**
     * @Route("/parcels", name="post_parcels", methods={"POST"})
     */
    public function index(ManagerRegistry $doctrine, Request $request): Response
    {
        // Deze regels halen de waardes uit het Request-object (de gegevens die in de front-end zijn ingevoerd) die nodig zijn om een parcel aan te maken.
        $entityManager = $doctrine->getManager();
        $name = $request->request->get('name');
        $deliveryDate = DateTime::createFromFormat('Y-m-d', $request->request->get('deliveryDate'));
        $address = $request->request->get('address');
        $postcode = $request->request->get('postcode');
        $city = $request->request->get('city');
        $country = $request->request->get('country');
        $weight = $request->request->get('weight');
        $length = $request->request->get('length');
        $height = $request->request->get('height');
        $width = $request->request->get('width');

        // Het tracking nummer wordt gegenereerd d.m.v. base64 encoding. Dit zorgt ervoor dat
        $tracking = substr(base64_encode($name . $request->request->get('deliveryDate') . $address . $postcode . $city . $country . $weight . $height . $width), 0, 8);
        $status = "Aangemeld";

        //Hier wordt een nieuw Parcel aangemaakt met de gegevens uit de POST request.
        $parcel = new Parcel();
        $parcel->setName($name);
        $parcel->setDeliveryDate($deliveryDate);
        $parcel->setDeliveryAddress($address);
        $parcel->setDeliveryZip($postcode);
        $parcel->setDeliveryCity($city);
        $parcel->setDeliveryCountry($country);
        $parcel->setWeight($weight);
        $parcel->setLength($length);
        $parcel->setHeight($height);
        $parcel->setWidth($width);
        $parcel->setTrackingNumber($tracking);
        $parcel->setParcelStatus($status);

        $entityManager->persist($parcel);
        $entityManager->flush();

        return $this->json('Parcel succesvol aangemaakt met trackingnummer ' . $tracking);
    }

    /**
     * @Route("/parcels/{trackingNumber}", name="get_parcel_by_trackingnumber", methods={"GET"})
     */
    public function show(ManagerRegistry $doctrine, string $trackingNumber): Response
    {
        $parcel = $doctrine->getRepository(Parcel::class)->findOneBy(["trackingNumber"=>$trackingNumber]);

        if (!$parcel) {
            return $this->json(['error' => "Geen parcel gevonden met trackingnummer " . $trackingNumber], 404);
        }
        $data =  [
            'name' => $parcel->getName(),
            'deliveryDate' => $parcel->getDeliveryDate()->format('d-m-Y'),
            'deliveryAddress' => $parcel->getDeliveryAddress(),
            'deliveryZip' => $parcel->getDeliveryZip(),
            'deliveryCity' => $parcel->getDeliveryCity(),
            'dimensions' => [
                'weight' => $parcel->getWeight(),
                'length' => $parcel->getLength(),
                'height' => $parcel->getHeight(),
                'width' => $parcel->getWidth()
            ],
            'trackingNumber' => $parcel->getTrackingNumber(),
            'status' => $parcel->getParcelStatus(),
        ];

        return $this->json($data);
    }

//    private static function generateTrackingNumber() {
//        $trackingNumber = "";
//        $trackingCharacters = "ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
//        $trackingLength = 6;
//
//        for($i = 0; $i < $trackingLength; $i++) {
//
//        }
//        return $trackingNumber;
//    }
}
