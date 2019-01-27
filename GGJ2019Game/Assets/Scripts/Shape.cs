
using System.Collections;
using System.Collections.Generic;
using UnityEngine;

public class Shape : MonoBehaviour
{
    public enum ShapeType {Ball, Cube, Prism};
    public ShapeType shapeType;
    public float loneliness = 0;
    public float lonelinessIncreaseRate = 1;
    public float outSideCircleIncreaseRate = 4;
    public bool isHomie = false;

    public ShapeMove shapeMove;

    //public bool passingBridge;

    Rigidbody rb;
   
    // Start is called before the first frame update
    void Start()
    {
        rb = GetComponent<Rigidbody>();
        shapeMove = GetComponent<ShapeMove>();
        if (gameObject.tag != "Player")
        {
            float r = Random.value;
            lonelinessIncreaseRate += r;
        }
        //passingBridge = false;
    }

    private void Update()
    {
        if(gameObject.tag == "Player")
        {
            if (InCircle())
            {
                loneliness += lonelinessIncreaseRate * Time.deltaTime;
            }
            else
            {
                loneliness += outSideCircleIncreaseRate * Time.deltaTime;
            }
        }
        else
        {
            if (InCircle())
            {
                loneliness += lonelinessIncreaseRate * Time.deltaTime;
            }
            else
            {
                loneliness += outSideCircleIncreaseRate * Time.deltaTime;
            }
            if (loneliness >= 100)
            {
                if (isHomie)
                {
                    Destroy(gameObject);
                    EventCenter.Emit("LoseHomie");
                }
                else
                {
                    loneliness = 0;
                }
            }
            if (isHomie)
            {
                Color color = new Color(loneliness / 100, (100 - loneliness) / 100, 0);
                GetComponent<MeshRenderer>().sharedMaterial.SetColor("_Color",color);
            }
        }
        
    }

    private void GameOver()
    {
        Debug.Log("Game Over");
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

    float DistanceToCenter()
    {
        return Mathf.Sqrt(transform.position.x * transform.position.x + transform.position.z * transform.position.z);
    }

    bool InCircle()
    {
        return DistanceToCenter() < Circle.radius;
    }
}
