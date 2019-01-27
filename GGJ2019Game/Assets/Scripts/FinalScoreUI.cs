using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using UnityEngine.UI;

public class FinalScoreUI : MonoBehaviour
{
    public Text text;
    public Score score;
    // Start is called before the first frame update
    void Start()
    {
        text = GetComponent<Text>();
        text.text = "Score: " + score.rvalue;
    }

    // Update is called once per frame
    void Update()
    {
        
    }
}
