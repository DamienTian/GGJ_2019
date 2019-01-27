using System.Collections;
using System.Collections.Generic;
using UnityEngine;

public class Shape : MonoBehaviour
{
    public enum ShapeType {Ball, Cube, Prism};
    public ShapeType shapeType;

    //public bool passingBridge;

    Rigidbody rb;
   
    // Start is called before the first frame update
    void Start()
    {
        rb = GetComponent<Rigidbody>();
        //passingBridge = false;
    }

    void FixedUpdate()
    {
        if (rb)
        {
            var currentVelocity = rb.velocity;

            if (currentVelocity.x <= 0f && currentVelocity.z <= 0f)
                return;

            currentVelocity.x = 0f;
            currentVelocity.z = 0f;

            rb.velocity = currentVelocity;
        }
    }
}
