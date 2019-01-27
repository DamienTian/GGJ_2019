using System;
using System.Collections;
using System.Collections.Generic;
using UnityEngine;

public class PlayerController : MonoBehaviour
{
    public float speed;
    private Shape shape;
    public float turnSpeed;

    // Companiers
    public List<Shape> companiers;
    public int companiersNum;

    // Recude loneliness amount
    public int reduceRate = 5;
    //private Rigidbody rb;

    void Start()
    {
        //rb = GetComponent<Rigidbody>();
        shape = GetComponent<Shape>();
    }

    void Update()
    {
        float moveHorizontal = Input.GetAxis("Horizontal");
        float moveVertical = Input.GetAxis("Vertical");

        Vector3 movement = new Vector3(moveHorizontal, 0.0f, moveVertical);

        Vector3 input = new Vector3(moveHorizontal, 0, moveVertical);

        transform.forward = Vector3.Lerp(
            transform.forward, input, turnSpeed*Time.deltaTime);

        transform.position += movement * speed * Time.deltaTime;
    }
}
