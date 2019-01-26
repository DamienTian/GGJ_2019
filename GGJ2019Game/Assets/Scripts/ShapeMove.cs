using System.Collections;
using System.Collections.Generic;
using UnityEngine;

public class ShapeMove : MonoBehaviour
{

    private Shape shape;
    private GameObject player;
    private Shape playerShape;
    private Rigidbody rb;

    public float movingToPlayerSpeed = 10.5f;
    public float maxAcceleration = 3;

    // The distance that we used to justify if the AI should approach to the player
    public float desireDistance = 6.5f;

    // The distance that prevent AI get too close to the player
    public float offsetBetween = 1.5f;

    // Direction from AI to player
    private Vector3 directionToPlayer;

    // Current distance between player and AI
    private float distanceToPlayer;

    // The current velocity of the AI.
    private Vector3 currentVelocity;

    // Start is called before the first frame update
    void Start()
    {
        shape = GetComponent<Shape>();
        player = GameObject.FindGameObjectWithTag("Player");
        playerShape = player.GetComponent<Shape>();
        currentVelocity = Vector3.zero;
        rb = GetComponent<Rigidbody>();
    }

    // Update is called once per frame
    void Update()
    {
        directionToPlayer = transform.position - player.transform.position;
        distanceToPlayer = Vector3.Magnitude(directionToPlayer);

        if (shape.shapeType == playerShape.shapeType)
        {
            if (distanceToPlayer <= offsetBetween)
            {
                currentVelocity = Vector3.zero;
            }
            else if (distanceToPlayer <= desireDistance)
            {
                Debug.Log("Here");
                ApproachToPlayer();
            }
        }
    }

    // Same type AI apparoch to player
    void ApproachToPlayer()
    {
        var desireVelocity = directionToPlayer.normalized * movingToPlayerSpeed;
        //Debug.Log(desireVelocity);

        var steering = desireVelocity - currentVelocity;
        steering = Vector3.ClampMagnitude(steering, maxAcceleration);

        currentVelocity = Vector3.ClampMagnitude(currentVelocity - steering, movingToPlayerSpeed);

        //rb.AddForce(currentVelocity);

        transform.position += currentVelocity * Time.deltaTime;
        transform.forward = currentVelocity.normalized;
    }
}
