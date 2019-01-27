//using System;
using System.Collections;
using System.Collections.Generic;
using UnityEngine;

public class ShapeMove : MonoBehaviour
{

    private Shape shape;
    private GameObject player;
    private Shape playerShape;
    private Rigidbody rb;

    public float movingToPlayerSpeed = 5f;
    public float maxAcceleration = 8;

    // The distance that we used to justify if the AI should approach to the player
    public float desireDistance = 10f;

    // The distance that prevent AI get too close to the player
    public float offsetBetween = 3f;

    // Direction from AI to player
    private Vector3 directionToPlayer;

    // Current distance between player and AI
    private float distanceToPlayer;

    // The current velocity of the AI.
    private Vector3 currentVelocity;

    // The decay rate for desire Distance
    public float decayRate = 1 / 5;

    // Start is called before the first frame update
    void Start()
    {
        shape = GetComponent<Shape>();
        player = GameObject.FindGameObjectWithTag("Player");
        playerShape = player.GetComponent<Shape>();
        currentVelocity = Vector3.zero;
        rb = GetComponent<Rigidbody>();
        float wanderInterval = Random.value + 2;
        InvokeRepeating("FreeMove", 0, wanderInterval);
    }

    // Update is called once per frame
    void Update()
    {
        directionToPlayer = transform.position - player.transform.position;
        distanceToPlayer = Vector3.Magnitude(directionToPlayer);

        if (shape.shapeType == playerShape.shapeType)
        {
            if (shape.isHomie)
            {
                WanderAroundPlayer();
            }
            else
            {
                if (distanceToPlayer <= desireDistance)
                {
                    ApproachToPlayer();
                    desireDistance += decayRate;
                    player.GetComponent<Player>().AddHomie(shape);
                    shape.isHomie = true;
                    int randomIndex = Random.Range(0, 8);
                    cellPosition = player.GetComponent<Player>().cells[randomIndex].position;
                }
                else
                {
                    desireDistance -= decayRate * Time.deltaTime;
                    transform.position = Vector3.Lerp(
                        transform.position, newPosition, moveSpeed * Time.deltaTime);
                    transform.forward = Vector3.Lerp(
                        transform.forward, newDirection, turnSpeed * Time.deltaTime);
                }
            }
        }

        else
        {
            desireDistance -= decayRate * Time.deltaTime;
            transform.position = Vector3.Lerp(
                transform.position, newPosition, moveSpeed * Time.deltaTime);
            transform.forward = Vector3.Lerp(
                transform.forward, newDirection, turnSpeed * Time.deltaTime);
        }
    }

    private float turnSpeed;
    private float moveSpeed;
    Vector3 newDirection;
    Vector3 newPosition;

    void FreeMove()
    {
        turnSpeed = Random.value * 5 + 5;
        moveSpeed = Random.value * 0.5f + 1;
        newDirection = new Vector3(Random.Range(-1f,1f), 0, Random.Range(-1f,1f)).normalized;
        newPosition = transform.position + newDirection * moveSpeed;
    }

    // Same type AI apparoch to player
    void ApproachToPlayer()
    {
        var desireVelocity = directionToPlayer.normalized * movingToPlayerSpeed;
        //Debug.Log(desireVelocity);

        var steering = desireVelocity - currentVelocity;
        steering = Vector3.ClampMagnitude(steering, maxAcceleration);

        currentVelocity = Vector3.ClampMagnitude(currentVelocity - steering, movingToPlayerSpeed);

        if (distanceToPlayer > offsetBetween && distanceToPlayer <= desireDistance)
        {
            transform.position += currentVelocity * Time.deltaTime;
            transform.forward = currentVelocity.normalized;
        }

    }

    Vector3 cellPosition;
    void WanderAroundPlayer()
    {
        Vector3 wanderPosition = cellPosition + player.transform.position;
        transform.position = Vector3.Lerp(
            transform.position, wanderPosition, moveSpeed * Time.deltaTime);
    }
}
