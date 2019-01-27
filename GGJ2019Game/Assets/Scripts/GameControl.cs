using System.Collections;
using System.Collections.Generic;
using UnityEngine;

public class GameControl : MonoBehaviour
{
    GameObject ground;

    // The area that initilize the player
    Vector3 bornArea;

    // This hold the initial group that player will meet at the first place 
    GameObject initGroup;

    // Find Camera
    //public Camera mainCamera;
    //CompleteCameraController completeCameraController;

    // Instantiant shapes
    public int numOfBall;
    public int numOfCube;
    public int numOfPrism;

    // Shape Prefabs
    public GameObject ball;
    public GameObject cube;
    public GameObject prism;

    public Material ballMat;

    private void Awake()
    {
        ground = GameObject.Find("Ground");
        initGroup = GameObject.Find("Initial Group");
        //completeCameraController = mainCamera.GetComponent<CompleteCameraController>();
        //bornArea = new Vector3(100,0,30);
        GeneratePlayer();

        GenerateShape();
    }

    private void GeneratePlayer()
    {
        Vector3 randomPos = new Vector3(Random.Range(-450,450), 0, Random.Range(325, 425));
        //Vector3 cameraPos = randomPos + new Vector3(0, completeCameraController.cameraHeight, 0);
        initGroup.transform.position = randomPos;
        //mainCamera.transform.position = cameraPos;

    }

    private void GenerateShape()
    {
        // Generate Ball
        for (int i = 0; i < numOfBall; i++)
        {
            Instantiate(ball, new Vector3(Random.Range(-490, 490), 0, Random.Range(-490, 490)), Quaternion.identity);
            Material mat = new Material(ballMat);
            ball.GetComponent<MeshRenderer>().material = mat;
        }

        // Generate Cube
        for (int i = 0; i < numOfCube; i++)
        {
            Instantiate(cube, new Vector3(Random.Range(-490, 490), 0, Random.Range(-490, 490)), Quaternion.identity);
        }

        // Generate prism
        for (int i = 0; i < numOfPrism; i++)
        {
            Instantiate(prism, new Vector3(Random.Range(-490, 490), 0, Random.Range(-490, 490)), Quaternion.identity);
        }
    }
}
