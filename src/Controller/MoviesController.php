<?php

namespace App\Controller;
use App\Entity\Movies;
use App\Entity\User;
use App\Form\SearchMoviesType;
use App\Repository\MoviesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

/**
 * @Route("/movies")
 */
class MoviesController extends AbstractController
{    
    /**
     * @Route("/search", name="movies_search", methods={"GET","POST"})
    */

    public function searchMovies(Request $request): Response
    {
        $user = new User();
        //We initiate serializer
        $encoders = [new XmlEncoder(), new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizers, $encoders);
        //Create form for search movie with api
        $form = $this->createForm(SearchMoviesType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            //When the form is submitted we get the title of movie
            $data = $form->getData();
            $title = $data['Title'];
            // create curl resource 
            $ch = curl_init(); 

            // set url 
            curl_setopt($ch, CURLOPT_URL, "http://www.omdbapi.com/?apikey=6e42a920&t=$title"); 

            //return the transfer as a string 
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 

            // $output contains the output string 
            $output = curl_exec($ch); 

            // close curl resource to free up system resources 
            curl_close($ch); 

            //We deserialize
            $movie = $serializer->deserialize($output, Movies::class, 'json');   

            //We save the movie in the database
            $user = $this->getUser();
            $movie->addUser($user);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($movie);
            $entityManager->flush();
        }   
        return $this->render('movies/search.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/index", name="movies_index", methods={"GET","POST"})
    */
    public function getMoviesByUser (Request $request): Response
    {
        $user = $this->getUser();
        $repository = $this->getDoctrine()->getRepository(Movies::class);
        $movies = $repository->getMoviesByUser($user);
        dump($movies);

        return $this->render('movies/index.html.twig', [
            'movies' => $movies,
        ]);
    }
}
