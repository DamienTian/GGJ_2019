using System.Collections;
using System.Collections.Generic;
using UnityEngine;

public class Circle : MonoBehaviour
{
    public static float radius;
    public float shrinkRate = 0.4f;
    // Start is called before the first frame update
    void Start()
    {
        
    }

    // Update is called once per frame
    void Update()
    {
        transform.localScale -= new Vector3(shrinkRate, shrinkRate,shrinkRate) * Time.deltaTime;
        radius = transform.localScale.x; 
    }
}
