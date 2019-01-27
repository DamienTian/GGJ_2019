using System.Collections;
using System.Collections.Generic;
using UnityEngine;

public class SpotLight : MonoBehaviour
{
    public GameObject player;
    private Light spotLight;
    public float height;
    public float maxSpotAngle;
    public AnimationCurve spotAngleCurve;
    // Start is called before the first frame update
    void Start()
    {
        spotLight = GetComponent<Light>();
        maxSpotAngle = spotLight.spotAngle;
    }

    // Update is called once per frame
    void Update()
    {
        transform.position = player.transform.position + new Vector3(0, height, 0);
        transform.LookAt(player.transform.position);
        spotLight.spotAngle = maxSpotAngle * spotAngleCurve.Evaluate(player.GetComponent<Shape>().loneliness / 100);
    }
}
