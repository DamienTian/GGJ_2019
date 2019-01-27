using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using UnityEngine.UI;

public class FindHomieUI : MonoBehaviour
{
    private Text text;
    private float tStamp;
    public float showTextDuration = 2;
    // Start is called before the first frame update
    void Start()
    {
        text = GetComponent<Text>();
        text.enabled = false;
    }

    private void OnEnable()
    {
        EventCenter.On("LoseHomie", LoseHomie);
    }

    private void OnDisable()
    {
        EventCenter.Off("LoseHomie", LoseHomie);
    }

    public void FindHomie(int i)
    {
        text.text = "Find a homie: " + i.ToString();
        text.color = Color.green;
        text.enabled = true;
        tStamp = 0;
    }

    public void LoseHomie()
    {
        text.text = "A homie dies";
        text.color = Color.red;
        text.enabled = true;
        tStamp = 0;
    }

    private void Update()
    {
        if (text.enabled == true)
        {
            tStamp += Time.deltaTime;
        }
        if (tStamp > showTextDuration)
        {
            text.enabled = false;
        }
    }
}
