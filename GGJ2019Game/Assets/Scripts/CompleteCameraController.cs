using System.Collections;
using System.Collections.Generic;
using UnityEngine;

public class CompleteCameraController : MonoBehaviour
{

    public GameObject player;       //Public variable to store a reference to the player game object


    public int cameraHeight;         //Private variable to store the offset distance between the player and camera

    // Use this for initialization
    void Start()
    {
        transform.forward = new Vector3(0, -1, 0);
    }

    // LateUpdate is called after Update each frame
    void LateUpdate()
    {
        // Set the position of the camera's transform to be the same as the player's, 
        // but offset by the calculated offset distance.
        transform.position = player.transform.position + new Vector3(0,cameraHeight,0);
    }
}
